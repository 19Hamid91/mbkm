<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Mbkm;
use App\Models\TypeProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DirekturController extends Controller
{
    function index(Request $req)
    {
        $tahun = date('Y');
        if($req->tahunTabel != null){
            $tahun = $req->tahunTabel;
        }
        $getQuery = Mbkm::with(['support', 'mahasiswa'])
        ->where([
            ['tahun', $tahun], 
            ['pers_kaprodi', '!=', null], 
            ['pers_kajur', '!=', null], 
            ['status', 'AKTIF']])
        ->whereHas('support', function ($query) {
            $query->where([
                ['trans_nilai', '!=', null], 
                ['pakta_integritas', '!=', null], 
                ['rekom_pt_asal', '!=', null], 
                ['pers_ortu', '!=', null]]);
        });
        $check = explode("=", $req->jurusanprodi);
        if($check[0] == "jurusan"){
            $getQuery->whereHas('mahasiswa', function($query) use($check) {
                $query->where('jurusan','=', $check[1]);
            });
        } elseif($check[0] == "prodi"){
            $getQuery->whereHas('mahasiswa', function($query) use($check) {
                $query->where('prodi','=', $check[1]);
            });
        }
        $data['direktur'] = $getQuery->get();
        // dd($req, $data);
        $data['tahun'] = Mbkm::groupBy('tahun')->pluck('tahun');
        $data['jurusan'] = Mahasiswa::groupBy('jurusan')->pluck('jurusan');
        $data['prodi'] = Mahasiswa::groupBy('prodi')->pluck('prodi');
        // return $data;
        // dd($data);
        return view('direktur.direktur', $data);
    }
    function dashboard()
    {
        $data['mbkm'] = Mbkm::with('mahasiswa')->where([['pers_kaprodi', '!=', null], ['pers_kajur', '!=', null], ['pers_direktur', null], ['status', 'AKTIF']])->whereHas('support', function ($query) {
            $query->where([['trans_nilai', '!=', null], ['pakta_integritas', '!=', null], ['rekom_pt_asal', '!=', null], ['pers_ortu', '!=', null], ['ket_sehat', '!=', null]]);
        })->get();
        $data['tahun'] = Mbkm::groupBy('tahun')->pluck('tahun');
        $data['jurusan'] = Mahasiswa::groupBy('jurusan')->pluck('jurusan');
        $data['prodi'] = Mahasiswa::groupBy('prodi')->pluck('prodi');
        // dd($data);
        // return $data;
        return view('direktur.dashboard', $data);
    }
    function dataAll($tahun){
        $types = TypeProgram::get();
        $all = Mbkm::with('mahasiswa')
        ->where('status', 'AKTIF')
        ->whereYear('date_pers', $tahun)
        ->get();
        
        foreach ($types as $type) {
            $count = 0;
            $newName = '';
            foreach($all as $item){
                if($item->type_program_id == $type->id){
                    $count++;
                };
            }
            $check = Str::wordCount($type->nama);
            if ($check > 2) {
                switch ($type->nama) {
                    case 'Kegiatan Wirausaha (UMKM)':
                        $newName = 'UMKM';
                        break;
                    case 'Studi/Proyek Independen (Bersertifikat Kampus Merdeka)':
                        $newName = 'Studi Independen';
                        break;
                    case 'Membangun Desa/Kuliah Kerja Nyata Tematik (KKN Tematik)':
                        $newName = 'KKN Tematik';
                        break;
                    case 'Magang Praktik Kerja (Magang Sertifikat MBKM)':
                        $newName = 'MBKM';
                        break;
                    case 'Asistensi Mengajar di Satuan Pendidikan':
                        $newName = 'Asistensi Mengajar';
                        break;
                }
                $data[$newName] = $count;
            } else {
                $data[$type->nama] = $count;
            }
        }

        return response()->json(['success' => 1, 'data' => $data]);
    }
    function dataJurusan($tahun, $jurusan){
        $types = TypeProgram::get();
        $getData = Mahasiswa::whereHas('mbkm', function ($query) use ($tahun) {
            $query->whereYear('date_pers', $tahun)->where('status', 'AKTIF');
        })
        ->where('jurusan', $jurusan)
        ->with('mbkm')
        ->get();
        
        foreach ($types as $type) {
            $count = 0;
            $newName = '';
            foreach($getData as $item){
                if($item->mbkm[0]->type_program_id == $type->id){
                    $count++;
                };
            }
            $check = Str::wordCount($type->nama);
            if ($check > 2) {
                switch ($type->nama) {
                    case 'Kegiatan Wirausaha (UMKM)':
                        $newName = 'UMKM';
                        break;
                    case 'Studi/Proyek Independen (Bersertifikat Kampus Merdeka)':
                        $newName = 'Studi Independen';
                        break;
                    case 'Membangun Desa/Kuliah Kerja Nyata Tematik (KKN Tematik)':
                        $newName = 'KKN Tematik';
                        break;
                    case 'Magang Praktik Kerja (Magang Sertifikat MBKM)':
                        $newName = 'MBKM';
                        break;
                    case 'Asistensi Mengajar di Satuan Pendidikan':
                        $newName = 'Asistensi Mengajar';
                        break;
                }
                $data[$newName] = $count;
            } else {
                $data[$type->nama] = $count;
            }
        }

        return response()->json(['success' => 1, 'data' => $data]);
    }
    function dataProdi($tahun, $prodi){
        $types = TypeProgram::get();
        $getData = Mahasiswa::whereHas('mbkm', function ($query) use ($tahun) {
            $query->whereYear('date_pers', $tahun)->where('status', 'AKTIF');
        })
        ->where('prodi', $prodi)
        ->with('mbkm')
        ->get();
        
        foreach ($types as $type) {
            $count = 0;
            $newName = '';
            foreach($getData as $item){
                if($item->mbkm[0]->type_program_id == $type->id){
                    $count++;
                };
            }
            $check = Str::wordCount($type->nama);
            if ($check > 2) {
                switch ($type->nama) {
                    case 'Kegiatan Wirausaha (UMKM)':
                        $newName = 'UMKM';
                        break;
                    case 'Studi/Proyek Independen (Bersertifikat Kampus Merdeka)':
                        $newName = 'Studi Independen';
                        break;
                    case 'Membangun Desa/Kuliah Kerja Nyata Tematik (KKN Tematik)':
                        $newName = 'KKN Tematik';
                        break;
                    case 'Magang Praktik Kerja (Magang Sertifikat MBKM)':
                        $newName = 'MBKM';
                        break;
                    case 'Asistensi Mengajar di Satuan Pendidikan':
                        $newName = 'Asistensi Mengajar';
                        break;
                }
                $data[$newName] = $count;
            } else {
                $data[$type->nama] = $count;
            }
        }

        return response()->json(['success' => 1, 'data' => $data]);
    }

    function dataTabel($tahun, $jurusan){
        $types = TypeProgram::get();
        $data = Mahasiswa::whereHas('mbkm', function ($query) use ($tahun) {
            $query->whereYear('date_pers', $tahun)->where('status', 'AKTIF');
        })
        ->where('jurusan', $jurusan)
        ->with('mbkm')
        ->get();

        return response()->json(['success' => 1, 'data' => $data]);
    }
}
