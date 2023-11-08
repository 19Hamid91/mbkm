<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\Notif;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KajurController extends Controller
{
    function index()
    {
        $getJurusan = Jurusan::where('user_id', Auth::user()->id)->first();
        $data['kaprodi'] = Mbkm::with(['support', 'mahasiswa'])->where([['tahun', date('Y')], ['status', 'WAITING'], ['pers_kaprodi', '!=', null], ['pers_kajur', '=', null]])->whereHas('support', function ($query) {
            $query->where([['trans_nilai', '!=', null], ['pakta_integritas', '!=', null], ['rekom_pt_asal', '!=', null], ['pers_ortu', '!=', null]]);
        })->whereHas('mahasiswa', function ($query) use($getJurusan){
            // $query->where([['jurusan', Auth::user()->dosen->jurusan], ['jenjang', Auth::user()->dosen->jenjang]]);
            $query->where('jurusan', $getJurusan->nama_jurusan);
        })->get();
        $data['datamhs'] = Mbkm::with(['support', 'mahasiswa'])->where('status', 'AKTIF')->whereHas('mahasiswa', function ($query) use($getJurusan){
            // $query->where([['jurusan', Auth::user()->dosen->jurusan], ['jenjang', Auth::user()->dosen->jenjang]]);
            $query->where('jurusan', $getJurusan->nama_jurusan);
        })->get();
        $data['tahun'] = Mbkm::groupBy('tahun')->pluck('tahun');
        $data['jurusan'] = Mahasiswa::groupBy('jurusan')->pluck('jurusan');
        $data['prodi'] = Mahasiswa::groupBy('prodi')->pluck('prodi');
        // return $data;
        return view('kaprodi.kaprodi', $data);
    }
    function acc($id)
    {
        $acc = Mbkm::where('id', $id)->update(
            [
                'pers_kajur' => 'Y',
                'date_pers' => date('Y-m-d'),
                'status' => 'AKTIF'
            ]
        );
        if ($acc) {
            $getMbkm = Mbkm::where('id', $id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user->id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Pengajuan MBKM sudah disetujui oleh Kajur"
            ]);
            if ($notif) {
                return response()->json(['success' => 1, 'message' => 'Pengajuan berhasil disetujui']);
            }
        }
    }
}
