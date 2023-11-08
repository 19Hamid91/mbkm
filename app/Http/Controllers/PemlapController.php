<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\Notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemlapController extends Controller
{
    function index()
    {
        $data['kaprodi'] = Mbkm::where([['tahun', date('Y')], ['dosbingex_id', Auth::user()->dosenex->id]])->whereNot('status', 'PASS')->get();
        return view('pemlap.pemlap', $data);
    }
    function acc($type, $id)
    {
        $getMbkm = Mbkm::where('id', $id)->first();

        if ($type == "logbook") {
            if ($getMbkm->dosbingex_report != null && $getMbkm->dosbing_logbook != null && $getMbkm->dosbing_report != null) {
                $status = "PASS";
            } else {
                $status = "AKTIF";
            }
            $update = Mbkm::where('id', $id)->update([
                'dosbingex_logbook' => 'Y',
                'status' => $status
            ]);
        } else {
            if ($getMbkm->dosbingex_logbook != null && $getMbkm->dosbing_report != null && $getMbkm->dosbing_logbook != null) {
                $status = "PASS";
            } else {
                $status = "AKTIF";
            }
            $update = Mbkm::where('id', $id)->update([
                'dosbingex_report' => 'Y',
                'status' => $status
            ]);
        }
        if ($update) {
            $getMbkm = Mbkm::where('id', $id)->first();
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user->id,
                'mbkm_id' => $getMbkm->id,
                'body' => "".$type." sudah disetujui oleh Pembimbing Lapangan"
            ]);
            if ($notif) {
                return response()->json(['success' => 1, 'message' => ''.$type.' berhasil disetujui']);
            }
        }
    }
    function logbook()
    {
        $data['kaprodi'] = Mbkm::where([['dosbingex_id', Auth::user()->dosenex->id]])->whereIn('status', ['PASS', 'AKTIF'])->get();
        return view('pembimbing.logbook', $data);
    }
    function report()
    {
        $data['kaprodi'] = Mbkm::where([['dosbingex_id', Auth::user()->dosenex->id], ['report', '!=', null]])->whereIn('status', ['PASS', 'AKTIF'])->get();
        return view('pembimbing.report', $data);
    }
    function nilai(Request $req)
    {
        $getMbkm = Mbkm::find($req->id);
        if($req->nilai < 0 || $req->nilai >100){
            return redirect()->back()->with('fail', 'Input berada diluar rentang nilai');
        }
        // $getMbkm->nilai_pemlap = ((int)$req->kognitif + (int)$req->kreatif + (int)$req->komunikasi + (int)$req->keaktifan) / 4;
        $getMbkm->nilai_pemlap = $req->nilai;
        $status = $getMbkm->update();
        if ($status) {
            $notif = Notif::create([
                'user_id' => $getMbkm->mahasiswa->user_id,
                'mbkm_id' => $getMbkm->id,
                'body' => "Pembimbing Lapangan telah menilai MBKM anda"
            ]);
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('fail', 'Data gagal diupdate');
        }
    }
}
