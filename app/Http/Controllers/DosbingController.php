<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Mahasiswa;
use App\Models\Mbkm;
use App\Models\Nilai;
use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosbingController extends Controller
{
    function index()
    {
        $data['kaprodi'] = Mbkm::where([['tahun', date('Y')], ['dosen_id', Auth::user()->dosen->id]])->whereNot('status', 'PASS')->get();
        return view('pembimbing.pem', $data);
    }
    function getLogbook($id)
    {
        $getLogbook = Logbook::where('mbkm_id', $id)
            ->orderBy('tanggal', 'asc')
            ->get();

        return response()->json(['success' => 1, 'message' => 'berhasil', 'data' => $getLogbook]);
    }
    public function updateStatus(Request $request, $id)
    {
        $statusValue = $request->input('status');
        $ketStatus = $statusValue == 1 ? "menyetujui" : "menolak";
    
        $logbook = Logbook::find($id);
        if (!$logbook) {
            return response()->json(['success' => 0, 'message' => 'Logbook tidak ditemukan'], 404);
        }
    
        $logbook->status = $statusValue;
        $logbook->note = $request->note;
        $check = $logbook->save();
        if($check){
            $getMbkm = Mbkm::where('id', $logbook->mbkm_id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user_id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Dosen Pembimbing telah ".$ketStatus." logbook anda"
            ]);
        }
    
        return response()->json(['success' => 1, 'message' => 'Status berhasil diperbarui']);
    }

    public function updateStatusex(Request $request, $id)
    {
        $statusValue = $request->input('statusex');
        $ketStatus = $statusValue == 1 ? "menyetujui" : "menolak";
    
        $logbook = Logbook::find($id);
        if (!$logbook) {
            return response()->json(['success' => 0, 'message' => 'Logbook tidak ditemukan'], 404);
        }
    
        $logbook->statusex = $statusValue;
        $logbook->notex = $request->notex;
        $check = $logbook->save();
        if($check){
            $getMbkm = Mbkm::where('id', $logbook->mbkm_id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user_id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Pembimbing Lapangan telah ".$ketStatus." logbook anda"
            ]);
        }
    
        return response()->json(['success' => 1, 'message' => 'Status berhasil diperbarui']);
    }
    
    function acc($type, $id)
    {
        $getMbkm = Mbkm::where('id', $id)->first();

        if ($type == "logbook") {
            if ($getMbkm->dosbingex_logbook != null && $getMbkm->dosbingex_report != null && $getMbkm->dosbing_report != null) {
                $status = "PASS";
            } else {
                $status = "AKTIF";
            }
            $update = Mbkm::where('id', $id)->update([
                'dosbing_logbook' => 'Y',
                'status' => $status
            ]);
        } else {
            if ($getMbkm->dosbingex_logbook != null && $getMbkm->dosbingex_report != null && $getMbkm->dosbing_logbook != null) {
                $status = "PASS";
            } else {
                $status = "AKTIF";
            }
            $update = Mbkm::where('id', $id)->update([
                'dosbing_report' => 'Y',
                'status' => $status
            ]);
        }
        if ($update) {
            $getMbkm = Mbkm::where('id', $id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user->id,
                'mbkm_id' => $getMbkm->id,
                'body' => "".$type." sudah disetujui oleh Dosen Pembimbing"
            ]);
            if ($notif) {
                return response()->json(['success' => 1, 'message' => ''.$type.' berhasil disetujui']);
            }
        }
    }
    function logbook()
    {
        $data['kaprodi'] = Mbkm::where([['dosen_id', Auth::user()->dosen->id]])->whereIn('status', ['PASS', 'AKTIF'])->get();
        return view('pembimbing.logbook', $data);
    }
    function report()
    {
        $data['kaprodi'] = Mbkm::where([['dosen_id', Auth::user()->dosen->id], ['report', '!=', null]])->whereIn('status', ['PASS', 'AKTIF'])->get();
        return view('pembimbing.report', $data);
    }
    function nilai(Request $req)
    {
        $getMbkm = Mbkm::find($req->id);
        if($req->nilai < 0 || $req->nilai >100){
            return redirect()->back()->with('fail', 'Input berada diluar rentang nilai');
        }
        // $getMbkm->nilai_dosbing = ((int)$req->kognitif + (int)$req->kreatif + (int)$req->komunikasi + (int)$req->keaktifan) / 4;
        $getMbkm->nilai_dosbing = $req->nilai;
        $status = $getMbkm->update();
        if ($status) {
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user_id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Dosen Pembimbing telah menilai MBKM anda"
            ]);
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('fail', 'Data gagal diupdate');
        }
    }
}
