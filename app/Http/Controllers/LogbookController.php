<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Mbkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    function logbook()
    {
        $data['mbkm'] = Mbkm::with('support')->where([['mahasiswa_id', Auth::user()->mahasiswa->id], ['status', 'AKTIF']])->orderBy('tahun', 'desc')->get();
        $data['tanggal'] = Logbook::select('tanggal')->where('mahasiswa_id', Auth::user()->mahasiswa->id)->get();
        return view('logbook.logbook', $data);
    }
    
    function getLogbook($id)
    {
        $data = Logbook::where('mbkm_id', $id)->get();
        return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $data]);
    }
}
