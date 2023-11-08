<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pic;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\TypeProgram;
use Illuminate\Support\Facades\Http;


class AdminController extends Controller
{
    public function index() {
        $data['pic'] = Pic::all();
        $data['jurusan'] = Jurusan::all();
        $data['prodi'] = Prodi::all();
        return view('admin.admin', $data);
    }
    public function getDataDosen($role) {
        $data = User::with('pic')->where('role',$role)->with('dosen')->orderBy('name')->get();
        // dd($data);
        return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $data]);
    }

    public function changeRole(Request $req){
        // dd($req);
        $user = User::where('email',$req->dosen)->first();
        if($req->role_baru == "PIC"){
            $checkDosen = Pic::where('dosen_id', $user->dosen->id)->first();
            if(!$checkDosen) {
                $createPic =Pic::find($req->pic);
                $createPic->user_id = $user->id;
                $createPic->dosen_id = $user->dosen->id;
                $createPic->update();
            } else {
                return redirect()->back()->with('fail', 'Dosen sudah ada');
            }
        } elseif($req->role_baru == "KAPRODI"){
            $getProdi = Prodi::where('id', $req->prodi)->first();
            if(!($getProdi->kaprodi && $getProdi->user_id)) {
                $getProdi->kaprodi = $user->dosen->nama;
                $getProdi->user_id = $user->id;
                $getProdi->update();
            } else {
                return redirect()->back()->with('fail', 'Kaprodi sudah ada');
            }
        } elseif($req->role_baru == "KAJUR"){
            $getJurusan = Jurusan::where('id', $req->jurusan)->first();
            if(!($getJurusan->kajur && $getJurusan->user_id)) {
                $getJurusan->kajur = $user->dosen->nama;
                $getJurusan->user_id = $user->id;
                $getJurusan->update();
            } else {
                return redirect()->back()->with('fail', 'Kajur sudah ada');
            }
        }
        $user->role = $req->role_baru;
        $user->update();
        
        return redirect()->back()->with('success', 'Role berhasil diupdate');
    }
    public function changeToDosen($id){
        $user = User::find($id);
        if($user->role == "PIC"){
            $getPic = Pic::where('user_id', $user->id)->first();
            $user->role = "DOSEN";
            $user->update();
            if($getPic) {
                
                $getPic->user_id = null;
                $getPic->dosen_id = null;
                $getPic->update();
                return response()->json(['success' => 1, 'message' => 'Data dan role PIC berhasil dihapus']);
            } else {
                return response()->json(['success' => 1, 'message' => 'Role PIC berhasil dihapus']);
            }
        } elseif($user->role == "KAPRODI"){
            $getProdi = Prodi::where('user_id', $id)->first();
            $user->role = "DOSEN";
            $user->update();
            if($getProdi) {
                
                $getProdi->kaprodi = null;
                $getProdi->user_id = null;
                $getProdi->update();
                return response()->json(['success' => 1, 'message' => 'Data dan role Kaprodi berhasil dihapus']);
            } else {
                return response()->json(['success' => 1, 'message' => 'Role Kaprodi berhasil dihapus']);
            }
        } elseif($user->role == "KAJUR"){
            $getJurusan = Jurusan::where('user_id', $id)->first();
            $user->role = "DOSEN";
            $user->update();
            if($getJurusan) {
                
                $getJurusan->kajur = null;
                $getJurusan->user_id = null;
                $getJurusan->update();
                return response()->json(['success' => 1, 'message' => 'Data dan role Kajur berhasil dihapus']);
            } else {
                return response()->json(['success' => 1, 'message' => 'Role Kajur berhasil dihapus']);
            }
        }
        $user->role = "DOSEN";
        $user->update();
    
        return response()->json(['success' => 1, 'message' => 'Role berhasil dihapus']);
    }

    public function getAllDosen($jenis){
        if($jenis == "all") {
            $data = User::where('role','DOSEN')->orderBy('name')->get();
            return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $data]);
        } elseif($jenis == "pic") {
            $data = User::where('role','DOSEN')->has('pic', '<', 1)->orderBy('name')->get();
            return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $data]);
        }
    }

    public function dosens() {
        $data['dosens'] = Dosen::orderBy('nama')->get();
        return view('admin.dosen', $data);
    }
    
    public function pic() 
    {
        $data['programs'] = TypeProgram::all();
        $data['pic'] = Pic::with(['dosen', 'typeProgram'])->get();
        return view ('admin.pic', $data);
    }
    public function addPic(Request $req) 
    {
        $checkPic = Pic::where('jenis_pic', $req->nama_pic)->first();
        if(!$checkPic) {
            $createPic = new Pic;
            $createPic->jenis_pic = $req->nama_pic;
            $createPic->type_program_id = $req->program_id;
            $createPic->save();
            return redirect()->back()->with('success', 'Berhasil Menambahkan PIC');
        } else {
            return redirect()->back()->with('fail', 'Nama PIC sudah ada');
        }
        
    }
    public function deletePic($id) 
    {
        $checkPic = Pic::find($id)->delete();
        if($checkPic){
            return response()->json(['success' => 1, 'message' => 'PIC berhasil dihapus']);
        } else {
            return response()->json(['success' => 0, 'message' => 'PIC gagal dihapus']);
        }
        
    }

    public function updateDataDosen($nip){
        $response = Http::withHeaders(['token-daspim' => '123'])
            ->get('https://simpeg.polines.ac.id/Dashboard/getPegawaiByKode/' . $nip);
            
        if ($response) {
            $res = $response->json();
            $getDosen = Dosen::where('nip', $nip)->first();
            $getDosen->nama = $res['nm_pegawai'];
            $getDosen->email = $res['email_pegawai'];
            $getDosen->nip = $res['nip_baru'];
            $getDosen->jenis_kelamin = $res['jenis_kelamin'];
            $getDosen->nidn = $res['nidn'];
            $getDosen->alamat_jalan = $res['alamat_jalan'];
            $getDosen->telepon_pegawai = $res['telepon_pegawai'];
            $getDosen->jabatan = "Dosen";
            if ($res['prodi'] != null) {
                if ($res['prodi']['nm_jenjang'] == "Diploma 3") {
                    $convJenjang = "Diploma III";
                    $convProdi = str_replace(' (D3)', '', $res['prodi']['nm_prodi']);
                } else {
                    $convJenjang = $res['prodi']['nm_jenjang'];
                    $convProdi = str_replace(' (S.Tr)', '', $res['prodi']['nm_prodi']);
                }
            } else {
                $convJenjang = "";
                $convProdi = "";
            }
            if ($res['jurusan'] == null) {
                $convJurusan = "";
            }

            $getDosen->jenjang = $convJenjang;
            $getDosen->jurusan = $convJurusan;
            $getDosen->prodi = $convProdi;
            $getDosen->update();

            return response()->json(['success' => 1, 'message' => 'Data berhasil diupdate']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Pemanggilan API gagal']);
        }
    }
    
    public function jurusan()
    {
        $data['jurusan'] = Jurusan::all();
        return view('admin.jurusan', $data);
    }
    public function addJurusan(Request $req) 
    {
        $checkJurusan = Jurusan::where('nama_jurusan', $req->nama_jurusan)->first();
        if(!$checkJurusan) {
            $createJurusan = new Jurusan;
            $createJurusan->nama_jurusan = $req->nama_jurusan;
            $createJurusan->save();
            return redirect()->back()->with('success', 'Berhasil menambahkan jurusan');
        } else {
            return redirect()->back()->with('fail', 'Nama jurusan sudah ada');
        }
        
    }
    public function deleteJurusan($id) 
    {
        $checkJurusan = Jurusan::find($id)->delete();
        if($checkJurusan){
            return response()->json(['success' => 1, 'message' => 'Jurusan berhasil dihapus']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Jurusan gagal dihapus']);
        }
        
    }
    public function prodi()
    {
        $data['jurusan'] = Jurusan::all();
        $data['prodi'] = Prodi::all();
        return view('admin.prodi', $data);
    }
    public function addProdi(Request $req) 
    {
        $checkJurusan = Jurusan::find($req->jurusan_id);
        $checkProdi = Prodi::where('nama_prodi', $req->nama_prodi)->first();
        if(!$checkProdi && $checkJurusan) {
            $createProdi = new Prodi;
            $createProdi->nama_prodi = $req->nama_prodi;
            $createProdi->jurusan_id = $req->jurusan_id;
            $createProdi->save();
            return redirect()->back()->with('success', 'Berhasil menambahkan prodi');
        } else {
            return redirect()->back()->with('fail', 'Nama prodi sudah ada atau nama jurusan tidak ditemukan');
        }
        
    }
    public function deleteProdi($id) 
    {
        $checkProdi = Prodi::find($id)->delete();
        if($checkProdi){
            return response()->json(['success' => 1, 'message' => 'Prodi berhasil dihapus']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Prodi gagal dihapus']);
        }
        
    }
}
