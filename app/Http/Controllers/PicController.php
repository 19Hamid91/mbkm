<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeProgram;
use App\Models\Pic;
use App\Models\Mbkm;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;

class PicController extends Controller
{
    function index() 
    {
        $data['mbkm'] = Mbkm::with(['mahasiswa', 'dosen', 'dosbingex'])->where('type_program_id', Auth::user()->pic->type_program_id)->whereIn('status', ['WAITING', 'AKTIF'])->get();
        $data['program'] = TypeProgram::where('id', Auth::user()->pic->type_program_id)->first();
        $data['dosen'] = Dosen::whereHas('user', function($query){
            $query->whereIn('role', ['KAPRODI', 'KAJUR', 'PIMPINAN']);
        })->orderBy('nama', 'asc')->get();
        // dd($data);
        return view ('pic.pic', $data);
    }
    function nilai(Request $req)
    {
        if($req->nilai_dosbing == null && $req->nilai_pemlap == null) {
            return redirect()->back()->with('fail', 'Field kosong');
        }
        $mbkm = Mbkm::find($req->id_mbkmpic);
        // dd($mbkm);
        if($req->nilai_dosbing){
            $mbkm->nilai_dosbing = $req->nilai_dosbing;
        }
        if($req->nilai_pemlap){
            $mbkm->nilai_pemlap = $req->nilai_pemlap;
        }
        $check = $mbkm->update();
        if($check) {
            return redirect()->back()->with('success', 'Nilai Mbkm telah diperbarui');
        } else {
            return redirect()->back()->with('fail', 'Gagal memperbarui nilai');
        }
    }
    function setsk (Request $req)
    {
        if($req->nosk == null && $req->direktur == null) {
            return redirect()->back()->with('fail', 'Field kosong');
        }
        $getMbkm = Mbkm::find($req->id_mbkmsk);
        if($req->nosk){
            $getMbkm->sk_direktur = $req->nosk;
        }
        if($req->direktur){
            $getMbkm->pers_direktur = $req->direktur;
        }
        $check = $getMbkm->update();
        if($check){
            return redirect()->back()->with('success', 'No SK sudah diperbarui');  
        } else {
            return redirect()->back()->with('fail', 'No SK gagal diperbarui');  
        }
    }
}
