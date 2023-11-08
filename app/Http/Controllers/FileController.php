<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Exports\mbkmExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class FileController extends Controller
{
    // public function exportCSV(){
    // $mbkm = Mbkm::with('mahasiswa', 'dosen', 'dosbingex', 'typeProgram')->get();
    // // dd($mbkm);
    // $csvFileName = 'mbkm.csv';
    // $headers = [
    //     'Content-Type' => 'text/csv',
    //     'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
    // ];

    // $handle = fopen('php://output', 'w');
    // fputcsv($handle, ['Nama', 'NIM','Prodi', 'Jurusan', 'Judul Kegiatan', 'Tipe Program', 'Durasi', 'Tanggal Persetujuan', 'Dosen Pembing', 'Pembimbing Lapangan', 'Nilai Akhir']);

    // foreach ($mbkm as $item) {
    //     fputcsv($handle, [
    //         $item->mahasiswa->nama, 
    //         $item->mahasiswa->nim, 
    //         $item->mahasiswa->prodi, 
    //         $item->mahasiswa->jurusan, 
    //         $item->judul_kegiatan, 
    //         $item->typeProgram->nama, 
    //         $item->durasi, 
    //         $item->date_pers, 
    //         $item->dosen ? $item->dosen->nama : '-', 
    //         $item->dosbingex ? $item->dosbingex->nama : '-',
    //         (($item->nilai_dosbing + $item->nilai_pemlap) / 2) == 0 ? "-" : ($item->nilai_dosbing + $item->nilai_pemlap) / 2,]);
    // }

    // fclose($handle);

    // return response('', 200, $headers);
    // }
    
    public function exportCSV(Request $req)
    {
        $tahun = $req->tahun;
        $jurusan = $req->jurusan;
        $prodi = $req->prodi;
        return Excel::download(new mbkmExport($tahun, $jurusan, $prodi), 'mbkm.xls');
    }
}
