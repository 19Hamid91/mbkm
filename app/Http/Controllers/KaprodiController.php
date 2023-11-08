<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mbkm;
use App\Models\Notif;
use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    function index()
    {
        // $dosen = Dosen::where('id', Auth::user()->dosen->id)->first();
        // return $dosen;
        $getProdi = Prodi::where('user_id', Auth::user()->id)->first();
        $nmProdi = explode(' ',$getProdi->nama_prodi);
        $jenjang = array_shift($nmProdi);
        if($jenjang = 'D3' || $jenjang = 'DIII'){
            $nmJenjang = 'Diploma III';
        } else{
            $nmJenjang = 'Sarjana Terapan';
        }
        $nmProdi = implode(' ',$nmProdi);
        $getJurusan = Jurusan::find($getProdi->jurusan_id);
        $data['dosen'] = Dosen::where('jurusan', Auth::user()->dosen->jurusan)->orderBy('nama','asc')->get();
        $data['kaprodi'] = Mbkm::with(['support', 'mahasiswa'])->where([['tahun', date('Y')], ['status', 'WAITING']])->whereHas('support', function ($query) {
            $query->where([['trans_nilai', '!=', null], ['pakta_integritas', '!=', null], ['rekom_pt_asal', '!=', null], ['pers_ortu', '!=', null]]);
        })->whereHas('mahasiswa', function ($query) use($nmProdi, $getJurusan, $nmJenjang) {
            // $query->where([['prodi', Auth::user()->dosen->prodi], ['jurusan', Auth::user()->dosen->jurusan], ['jenjang', Auth::user()->dosen->jenjang]]);
            $query->where([['prodi', $nmProdi], ['jurusan', $getJurusan->nama_jurusan], ['jenjang', $nmJenjang]]);
        })->get();
        $data['datamhs'] = Mbkm::with(['support', 'mahasiswa'])->where('status', 'AKTIF')->whereHas('mahasiswa', function ($query)  use($nmProdi, $getJurusan, $nmJenjang) {
            // $query->where([['prodi', Auth::user()->dosen->prodi], ['jenjang', Auth::user()->dosen->jenjang]]);
            $query->where([['prodi', $nmProdi], ['jurusan', $getJurusan->nama_jurusan], ['jenjang', $nmJenjang]]);
        })->get();
        // dd($getJurusan, $getProdi);
        // return $data;
        $data['tahun'] = Mbkm::groupBy('tahun')->pluck('tahun');
        $data['jurusan'] = Mahasiswa::groupBy('jurusan')->pluck('jurusan');
        $data['prodi'] = Mahasiswa::groupBy('prodi')->pluck('prodi');
        return view('kaprodi.kaprodi', $data);
    }
    function acc(Request $req)
    {
        $acc = Mbkm::where('id', $req->id)->update(
            [
                'pers_kaprodi' => 'Y',
                'date_pers' => date('Y-m-d'),
            ]
        );
        if ($acc) {
            $getMbkm = Mbkm::where('id', $req->id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user->id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Pengajuan MBKM sudah disetujui oleh Kaprodi"
            ]);
            if ($notif) {
                return response()->json(['success' => 1, 'message' => 'Pengajuan berhasil disetujui']);
            }
        }
    }
    function setDosbing(Request $req)
    {
        $setDosbing = Mbkm::where('id', $req->id)->update(
            [
                'dosen_id' => $req->dosen,
            ]
        );
        if ($setDosbing) {
            $getMbkm = Mbkm::where('id', $req->id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user->id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Kamu sudah mendapatkan dosen pembimbing"
            ]);
            if ($notif) {
                // return redirect()->back()->with('success', 'Dosbing berhasil diset');
                return response()->json(['success' => 1, 'message' => 'Dosbing berhasil diset']);
                return redirect()->back()->with('success', 'Dosbing berhasil diset');
            }
        }
    }
}
