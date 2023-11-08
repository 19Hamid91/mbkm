<?php

namespace App\Exports;

use App\Models\mbkm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class mbkmExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $tahun;
    private $jurusan;
    private $prodi;
    
    public function __construct($tahun, $jurusan, $prodi)
    {
        $this->tahun = $tahun;
        $this->jurusan = $jurusan;
        $this->prodi = $prodi;
    }
    public function collection()
    {
       $query = DB::table('mbkms as mb')
        ->select(
            'mhs.nama',
            'mhs.nim',
            'mhs.prodi',
            'mhs.jurusan',
            'tp.nama as type_program_name',
            'mb.status',
            'mb.nama_lembaga',
            'mb.tanggal_awal',
            'mb.tanggal_akhir',
            'dsn.nama as dosen_name',
            'dsx.nama as dosbingex_name',
            'mb.nilai_dosbing',
            'mb.nilai_pemlap'
        )
        ->leftJoin('mahasiswas as mhs', 'mb.mahasiswa_id', '=', 'mhs.id')
        ->leftJoin('dosens as dsn', 'mb.dosen_id', '=', 'dsn.id')
        ->leftJoin('dosbingexes as dsx', 'mb.dosbingex_id', '=', 'dsx.id')
        ->leftJoin('type_programs as tp', 'mb.type_program_id', '=', 'tp.id');

        if ($this->tahun) {
            $query->where('mb.tahun', $this->tahun);
        }
    
        if ($this->jurusan) {
            $query->where('mhs.jurusan', $this->jurusan);
        }
    
        if ($this->prodi) {
            $query->where('mhs.prodi', $this->prodi);
        }
    
        return $query->orderBy('mhs.nim')->get();
    }

    public function headings(): array
    {
        return ["Mahasiswa", "NIM", "Prodi", "Jurusan", "Program", "Status", "Lembaga", "Tanggal mulai", "Tanggal akhir", "Dosen Pembimbing", "Pembimbing Lapangan", "Nilai Dosen Pembimbing", "Nilai Pembimbing Lapangan"];
    }
}
