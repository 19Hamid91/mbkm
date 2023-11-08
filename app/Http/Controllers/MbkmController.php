<?php

namespace App\Http\Controllers;

use App\Mail\EmailPemlap;
use App\Models\Dosbingex;
use App\Models\Dosen;
use App\Models\Kkn;
use App\Models\KknMember;
use App\Models\Logbook;
use App\Models\Mahasiswa;
use App\Models\MatkulSwap;
use App\Models\Mbkm;
use App\Models\Support;
use App\Models\SwapStudent;
use App\Models\TypeProgram;
use App\Models\TypeSwap;
use App\Models\User;
use App\Models\Notif;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PdfToImage;;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class MbkmController extends Controller
{
    function in()
    {
        $data['mbkm'] = Mbkm::with('support')->where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['jenis_mbkm', 'in']])->whereIn('status', ['WAITING', 'AKTIF'])->orderBy('tahun', 'desc')->get();
        $data['dosen'] = Dosen::whereHas('user', function($query){
            $query->whereIn('role', ['KAPRODI', 'KAJUR', 'PIMPINAN']);
        })->orderBy('nama', 'asc')->get();
        // return $data;
        return view('mbkm.mbkm', $data);
    }
    function save($id)
    {
        $data['mbkm'] = Mbkm::with(['typeProgram', 'mahasiswa', 'studentSwap.matkulSwap', 'kkn.kknMember'])->where('id', $id)->first();
        $pdf = Pdf::loadView('save.save', $data);
        return $pdf->stream('invoice.pdf');
    }
    function regis()
    {
        $data['program'] = TypeProgram::get();
        $data['swap'] = TypeSwap::get();
        $data['mahasiswa'] = Mahasiswa::where('user_id',Auth::user()->id)->first();
        $data['allMhs'] = Mahasiswa::all();
        if($data['mahasiswa']->ipk == null){
            $bulan = [9,10,11,12,1,2]; //smt ganjil
            if(in_array(now()->month, $bulan)){
                $tahun =  date('Y', strtotime('-1 year'));
                $smt = '2';
            } else {
                $tahun = now()->year;
                $smt = '1';
            }
            
            $lastSmtId = $tahun.$smt;
            $getToken = Http::post('https://simadu.polines.ac.id/api/login', [
                "email" => "omahiot@gmail.com",
                "password" => "Polines#2022"
                ])->json();
                
            $getIPK = Http::withHeaders([
                'Authorization' => 'Bearer ' . $getToken['data']['token']
            ])->get('https://simadu.polines.ac.id/api/trakm/'.$lastSmtId)->json();
            $filteredArray = Arr::where($getIPK['data'], function ($value, $key) {
                return $value['NIM'] == Auth::user()->email;
            });
            $arrKey = array_keys($filteredArray);

            if($filteredArray[$arrKey[0]]){
                $data['mahasiswa']->ipk = $filteredArray[$arrKey[0]]['Indek_prestasi_Kumulatif'];
                $data['mahasiswa']->update();
                $data['ipk'] = $data['mahasiswa']->ipk;
            } else {
                 $data['ipk'] = 0;
            }
        } else {
            $data['ipk'] = $data['mahasiswa']->ipk;
        }
        // dd($data);
        return view('mbkm.regis', $data);
    }
    function form(Request $req)
    {
        if ($req->forma) {
            $image = $req->file('forma');
            $ex = $image->getClientOriginalExtension();
            $name = "Form-" . date('hsiwdms') . "." . $ex;
            $image->move('img/form/', $name);
        } else {
            return redirect()->back()->with('fail', 'Anda harus upload file');
        }
        $update = Mbkm::where('id', $req->id)->update([
            'form_mbkm' => $name

        ]);
        if ($update) {
            return redirect()->back()->with('success', 'Form Pengajuan berhasil diupload');
        }
    }
    function report(Request $req)
    {
        if ($req->report) {
            $image = $req->file('report');
            $ex = $image->getClientOriginalExtension();
            if ($ex == "pdf") {
                $name = "Report-" . date('hsiwdms') . "." . $ex;
                $image->move('img/report/', $name);
            } else {
                return redirect()->back()->with('fail', 'File yang diupload harus .pdf');
            }
        } else {
            return redirect()->back()->with('fail', 'Anda harus upload file');
        }
        $update = Mbkm::where('id', $req->id)->update([
            'report' => $name
        ]);
        if ($update) {
            return redirect()->back()->with('success', 'Laporan berhasil diupload');
        }
    }

    function logbook(Request $req)
    {
        $insertLogbook = Logbook::create([
            'mbkm_id' => $req->id,
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'body' => $req->body,
            'tanggal' => $req->tanggal
        ]);
        if ($insertLogbook) {
            $getMbkm = Mbkm::where('id', $req->id)->first();
            if($getMbkm->dosbingex_id != null){
                $notif = Notif::create([
                    'user_id' => $getMbkm->pemEx->user_id,
                    'mbkm_id' => $getMbkm->id,
                    'body' => $getMbkm->mahasiswa->nama." telah mengisi logbook"
                ]);
            }
            if($getMbkm->dosen_id != null){
                $notif = Notif::create([
                    'user_id' => $getMbkm->dosen->user->id,
                    'mbkm_id' => $getMbkm->id,
                    'body' => $getMbkm->mahasiswa->nama." telah mengisi logbook"
                ]);
            }
            return redirect()->back()->with('success', 'Logbook berhasil diupload');
        }
    }
    function out()
    {
        $data['mbkm'] = Mbkm::where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['jenis_mbkm', 'out']])->get();
        return view('mbkm.mbkm', $data);
    }
    function register(Request $req)
    {
        $lastUrl = $req->input('lastUrl');
        // return $req->all();
        $data['type'] = $req->t;
        $getMbkm = Mbkm::where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['tahun', date('Y')]])->first();
        if ($getMbkm) {
            if ($getMbkm->status == "AKTIF") {
                return redirect()->back()->with('fail', 'Sedang Pengajuan Masih Aktif');
            } elseif ($getMbkm->status == "DITOLAK") {
                return redirect()->back()->with('fail', 'Silahkan Edit Pengajuan yg telah ditolak');
            } elseif ($getMbkm->status == "WAITING") {
                if ($getMbkm->pers_kaprodi == null || $getMbkm->pers_kajur == null || $getMbkm->pers_direktur == null) {
                    return redirect()->back()->with('fail', 'Silahkan Tunggu Persetujuan ');
                } elseif ($getMbkm->support->trans_nilai == null || $getMbkm->support->pakta_integritas == null || $getMbkm->support->rekom_pt_asal == null || $getMbkm->support->pers_ortu == null) {
                    return redirect()->back()->with('fail', 'Silahkan Lengkapi Data anda');
                }
            }
        }
        // } else {
        $id_pertukaran = null;
        $id_kkn = null;
        if (
            $req->program == 8
        ) {
            $insertPertukaran = SwapStudent::create([
                'type_swap_id' => $req->pertukarann_pelajar,
                'nama_prodi' => $req->nama_program_studi_tujuan,
                'mahasiswa_id' => Auth::user()->mahasiswa->id
            ]);
            if ($insertPertukaran) {
                $getDataInsert = SwapStudent::where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['nama_prodi', $req->nama_program_studi_tujuan]])->orderBy('created_at', 'desc')->first();
                $id_pertukaran = $getDataInsert->id;
                foreach ($req->nama_matkul as $a) {
                    $insertNamaAnggota = MatkulSwap::create([
                        'swap_student_id' => $getDataInsert->id,
                        'matkul' => $a
                    ]);
                }
            } else {
                $id_pertukaran = null;
            }
        } elseif ($req->program == 5) {
            $insertKkn = Kkn::create([
                'pendanaan' => $req->dana,
                'jumlah_anggota' => $req->jumlah_anggota,
                'mahasiswa_id' => Auth::user()->mahasiswa->id
            ]);
            if ($insertKkn) {
                $getDataInsertKkn = Kkn::where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['pendanaan', $req->dana], ['jumlah_anggota', $req->jumlah_anggota]])->orderBy('created_at', 'desc')->first();
                $id_kkn = $getDataInsertKkn->id;
                foreach ($req->nama_anggota as $a) {
                    $datamhs = Mahasiswa::find($a);
                    $insertNamaAnggota = KknMember::create([
                        'kkn_id' => $getDataInsertKkn->id,
                        'mahasiswa_id' => $a,
                        'nama' => $datamhs->nama
                    ]);
                }
            } else {
                $id_kkn = null;
            }
        }
        
        if ($req->hasFile('portofolio')) {
            $getPortofolio = $req->file('portofolio');
        // dd($req, $getPortofolio);
            $ex = $getPortofolio->getClientOriginalExtension();
            if ($ex == "pdf") {
                $namePortofolio = "Portofolio-" . date('wyihs') . "." . $ex;
                // $getPortofolio->move('img/support/portofolio/', $namePortofolio);
                $filePath = 'img/support/portofolio/' . $namePortofolio;
                
                //compress file
                $this->compressPdf($getPortofolio, $filePath);
            } else {
                return redirect()->back()->with('fail', 'File harus .pdf');
            }
        } elseif(!$req->hasFile('portofolio') && Auth::user()->mahasiswa->ipk < 2.75) {
            return redirect()->back()->with('fail', 'File tidak ada');
        } else {
            $namePortofolio = null;
        }
        
        $insertMbkm = Mbkm::create([
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'jenis_mbkm' => $req->t,
            'type_program_id' => $req->program,
            'prodi' => $req->prodi,
            'alasan' => $req->alasan,
            'nama_lembaga' => $req->nama_lembaga,
            'tanggal_awal' => $req->TglAwal,
            'tanggal_akhir' => $req->TglAkhir,
            'durasi' => $req->durasi,
            'rincian' => $req->rincian,
            'judul_kegiatan' => $req->judul_program,
            'swap_student_id' => $id_pertukaran,
            'kkn_id' => $id_kkn,
            'status' => "WAITING",
            'tahun' => date('Y'),
            'portofolio' => $namePortofolio
        ]);
        if ($insertMbkm) {
            $getData = Mbkm::where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['tahun', date('Y')]])->latest()->first();
            $createSupport = Support::create([
                'mbkm_id' => $getData->id,
            ]);

            // $data['support']=
            // return view('mbkm.support', $data);

            return redirect($lastUrl)->with('success', 'Form berhasil disimpan');
        }
    }
    function support($id, Request $req)
    {
        $data['type'] = $req->t;
        $getSupport = Support::where('mbkm_id', $id)->first();
        $data['id'] = $id;
        $array = array();
        $array[] = $getSupport->trans_nilai;
        $array[] = $getSupport->pakta_integritas;
        $array[] = $getSupport->rekom_pt_asal;
        $array[] = $getSupport->pers_ortu;
        $array[] = $getSupport->ket_sehat;
        // return $array;
        $data['data'] = $array;
        return view('mbkm.support', $data);
    }
    function supportAct(Request $req)
    {
        // dd($req->all());
        $getData = Support::where('mbkm_id', $req->id)->first();
        // return $getData;
        if ($req->nilai) {
            $getNilai = $req->file('nilai');
            $ex = $getNilai->getClientOriginalExtension();
            if ($ex == "pdf") {
                $nameNilai = "Nilai-" . date('wyihs') . "." . $ex;
                $getNilai->move('img/support/nilai/', $nameNilai);
            } else {
                return redirect()->back()->with('fail', 'File harus .pdf');
            }
        } else {
            $nameNilai = $getData->trans_nilai;
        }
        if ($req->pakta) {
            $getPakta = $req->file('pakta');
            $ex = $getPakta->getClientOriginalExtension();
            if ($ex == "pdf") {
                $namePakta = "Pakta-" . date('wyihs') . "." . $ex;
                $getPakta->move('img/support/pakta/', $namePakta);
            } else {
                return redirect()->back()->with('fail', 'File harus .pdf');
            }
        } else {
            $namePakta = $getData->pakta_integritas;
        }
        if ($req->surat_rekom) {
            $getRekom = $req->file('surat_rekom');
            $ex = $getRekom->getClientOriginalExtension();
            if ($ex == "pdf") {
                $nameRekom = "Rekom-" . date('wyihs') . "." . $ex;
                $getRekom->move('img/support/rekom/', $nameRekom);
            } else {
                return redirect()->back()->with('fail', 'File harus .pdf');
            }
        } else {
            $nameRekom = $getData->rekom_pt_asal;
        }
        if ($req->surat_persetujuan_ortu) {
            $getOrtu = $req->file('surat_persetujuan_ortu');
            $ex = $getOrtu->getClientOriginalExtension();
            if ($ex == "pdf") {
                $nameOrtu = "Ortu-" . date('wyihs') . "." . $ex;
                $getOrtu->move('img/support/ortu/', $nameOrtu);
            } else {
                return redirect()->back()->with('fail', 'File harus .pdf');
            }
        } else {
            $nameOrtu = $getData->pers_ortu;
        }
        if ($req->ket_sehat) {
            $getSehat = $req->file('ket_sehat');
            $ex = $getSehat->getClientOriginalExtension();
            if ($ex == "pdf") {
                $nameSehat = "Sehat-" . date('wyihs') . "." . $ex;
                $getSehat->move('img/support/sehat/', $nameSehat);
            } else {
                return redirect()->back()->with('fail', 'File harus .pdf');
            }
        } else {
            $nameSehat = $getData->ket_sehat;
        }
        $insert = Support::where('mbkm_id', $req->id)->update([
            'trans_nilai' => $nameNilai,
            'pakta_integritas' => $namePakta,
            'rekom_pt_asal' => $nameRekom,
            'pers_ortu' => $nameOrtu,
            'ket_sehat' => $nameSehat
        ]);
        if ($insert) {
            $getFile = Support::where('mbkm_id', $req->id)->first();
            if ($getFile->trans_nilai != null && $getFile->pakta_integritas != null && $getFile->rekom_pt_asal != null && $getFile->pers_ortu != null) {
                return redirect('/mbkm/in')->with('success', 'Selamat Data anda sudah lengkap, tunggu persetujuan dari kaprodi, kajur dan direktur');
            }
            return redirect()->back()->with('success', 'File berhasil diupload, Lengkapi file yang kurang lengkap');
        }
    }
    function info($id)
    {
        $getMbkm = Mbkm::with(['typeProgram', 'mahasiswa', 'studentSwap.matkulSwap', 'studentSwap.typeSwap', 'kkn.kknMember', 'dosen', 'pemEx'])->where('id', $id)->first();
        return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $getMbkm]);
    }
    function showSupport($id)
    {
        $getMbkm = Mbkm::with('support')->where('id', $id)->first();
        // number_format()
        return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $getMbkm]);
    }
    function pemlabAdd(Request $req)
    {
        $checkEmail = User::where('email', $req->email)->first();
        if($checkEmail){
            return redirect()->back()->with('fail', 'Email sudah digunakan');
        }
        $createUser = User::create([
            'email' => $req->email,
            'name' => $req->nama,
            'password' => bcrypt("mbkm" . date('Y')),
            'role' => 'PEMLAP'
        ]);
        $link = url('/');
        $email = $req->email;
        $password = "mbkm". date('Y');
        Mail::to($email)->send(new EmailPemlap($link, $email, $password));
        if ($createUser) {
            $getUser = User::where([['email', $req->email], ['name', $req->nama]])->first();
            $createDosbingEx = Dosbingex::create([
                'user_id' => $getUser->id,
                'nama' => $getUser->name,
                'email' => $getUser->email,
                'jabatan' => $req->jabatan
            ]);
            if ($createDosbingEx) {
                $getUserDosenEx = Dosbingex::where([['email', $req->email], ['nama', $req->nama], ['jabatan', $req->jabatan]])->first();
                $updateMbkm = Mbkm::where('id', $req->id)->update([
                    'dosbingex_id' => $getUserDosenEx->id
                ]);
                if ($updateMbkm) {
                    return redirect()->back()->with('success', 'User untuk dosen pembimbing lapangan berhasil dibuat');
                }
            }
        }
    }
    function history()
    {
        $data['mbkm'] = Mbkm::with('support')->where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['status', 'PASS']])->orderBy('tahun', 'desc')->get();
        return view('mbkm.history', $data);
    }

    public function updateBody(Request $request, $id)
    {
        $logbook = Logbook::find($id);

        $request->validate([
            'body' => 'required',
            'tanggal' => 'required'
        ]);

        $logbook->body = $request->input('body');
        $logbook->tanggal = $request->input('tanggal');
        $logbook->status = 0;
        $logbook->statusex = 0;
        $logbook->note = "";
        $logbook->notex = "";
        $logbook->save();

        return response()->json(['success' => 1, 'message' => 'Logbook berhasil diperbarui']);

        // return redirect('/logbooks')->with('success', 'Logbook telah berhasil diperbarui.');
    }

    function deleteLogbooks($id)
    {
        $logbook = Logbook::find($id)->delete();
        if($logbook){
            return response()->json(['success' => 1, 'message' => 'Berhasil menghapus logbook']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Gagal menghapus logbook']);
        }

    }
    function sk(Request $req, $id)
    {
        $check = Mbkm::find($id);
        if($check->sk_direktur == null){
            return redirect()->back()->with('fail', 'Surat Rekomendasi Belum Dibuat, Silakan Hubungi PIC');
        }
        $data['mbkm'] = Mbkm::with(['typeProgram', 'mahasiswa', 'studentSwap.matkulSwap', 'kkn.kknMember'])->where('id', $id)->first();
        $getDosen = Dosen::find($check->pers_direktur);
        $data['no_sk'] = $check->sk_direktur;
        $data['dosen'] = $getDosen;
        $bulan = [9,10,11,12,1,2]; //smt ganjil
        if(in_array(now()->month, $bulan)){
            $tahun =  date('Y', strtotime('-1 year'));
            $smt = '2';
        } else {
            $tahun = now()->year;
            $smt = '1';
        }
        
        $lastSmtId = $tahun.$smt;
        $getToken = Http::post('https://simadu.polines.ac.id/api/login', [
            "email" => "omahiot@gmail.com",
            "password" => "Polines#2022"
            ])->json();
            
        $getIPK = Http::withHeaders([
            'Authorization' => 'Bearer ' . $getToken['data']['token']
        ])->get('https://simadu.polines.ac.id/api/trakm/'.$lastSmtId)->json();
        $filteredArray = Arr::where($getIPK['data'], function ($value, $key) {
            return $value['NIM'] == Auth::user()->email;
        });
        $arrKey = array_keys($filteredArray);
        $data['ipk'] = $filteredArray[$arrKey[0]]['Indek_prestasi_Kumulatif'];
        // dd($data);
        $pdf = Pdf::loadView('save.sk', $data);
        return $pdf->stream('sk.pdf');
    }
    function template($jenis)
    {
        if ($jenis == "pakta") {
            $data['mhs'] = Mahasiswa::where('user_id',Auth::user()->id)->first();
            // dd($data);
            $pdf = Pdf::loadView('save.pakta', $data);
            return $pdf->stream('template'.$jenis.'.pdf');
        } elseif($jenis == "rekomendasi") {
            $pdf = Pdf::loadView('save.rekomendasi');
            return $pdf->stream('template'.$jenis.'.pdf');
        } elseif($jenis == "ortu") {
            $pdf = Pdf::loadView('save.ortu');
            return $pdf->stream('template'.$jenis.'.pdf');
        } elseif($jenis == "sehat") {
            $data = 0;
            $pdf = Pdf::loadView('save.sehat', $data);
            return $pdf->stream('template'.$jenis.'.pdf');
        } else {
            redirect()->back();
        }
        
    }
    function compressPdf($inputPdf, $outputPath)
    {
        $pdf = new PdfToImage($inputPdf->path());
        $pdf->setCompressionQuality(1); // Adjust the compression quality as needed
        $pdf->saveImage($outputPath);
    }
}
