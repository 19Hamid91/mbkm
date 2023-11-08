<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            font-family: "Muli";
            font-weight: 350;
        }
    </style>
</head>
<body>
    <center>
        <h5 style="font-family: Muli">
            Formulir Pendaftaran Merdeka Belajar 
        </h5>
        <h5>
            Politeknik Negeri Semarang
        </h5>
        <h5>
            Tahun {{ $mbkm->tahun }} 
        </h5>
    </center>
    <br>
    <br>
    <table class="table">
        <tr>
            <td style="width: 30%">Nama</td>
            <td style="width: 1%">:</td>
            <td>{{ $mbkm->mahasiswa->nama }}</td>
        </tr>
        <tr>
            <td>Nomor Induk Mahasiswa</td>
            <td>:</td>
            <td>{{ $mbkm->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td>Program Studi Asal</td>
            <td>:</td>
            <td>{{ $mbkm->prodi }}</td>
        </tr>
        <tr>
            <td>Jenis Program Merdeka Belajar</td>
            <td>:</td>
            <td>{{ $mbkm->typeProgram->nama }}</td>
        </tr>
        <tr>
            <td>Alsan Memilih Program</td>
            <td>:</td>
            <td>{{ $mbkm->alasan }}</td>
        </tr>
        <tr>
            <td>Judul Program/Kegiatan</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nama Lembaga Mitra (jika ada)</td>
            <td>:</td>
            <td>{{ $mbkm->nama_lembaga }}</td>
        </tr>
        <tr>
            <td>Durasi Kegiatan</td>
            <td>:</td>
            <td>{{ $mbkm->durasi }} Bulan</td>
        </tr>
        <tr>
            <td>Rincian Kegiatan</td>
            <td>:</td>
            <td>{{ $mbkm->rincian }}</td>
        </tr>
        @if ($mbkm->type_program_id==5)
            <tr>
                <td colspan="3">
                    <center><b>Program Membangun Desa/Kuiah Kerja Nyata Tematik</b></center>
                </td>
            </tr>
            <tr>
                <td>Sumber Pendanaan (jika ada)</td>
                <td>:</td>
                <td>{{ $mbkm->kkn->pendanaan }}</td>
            </tr>
            <tr>
                <td>Jumlah Anggota</td>
                <td>:</td>
                <td>{{ $mbkm->kkn->jumlah_anggota }} Anggota</td>
            </tr>
            <tr>
                <td>Nama Anggota</td>
                <td>:</td>
                <td>
                    <table style="width: 100%">
                        @foreach ($mbkm->kkn->kknMember as $item)
                            <tr><td>{{ $item->nama }}</td></tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @elseif($mbkm->type_program_id==8)
            <tr>
                <td colspan="3"><center><b>Program Pertukaran Pelajar</b></center></td>
            </tr>
            <tr>
                <td>Jenis Pertukaran Pelajar</td>
                <td>:</td>
                <td>{{ $mbkm->studentSwap->typeSwap->jenis }}</td>
            </tr>
            <tr>
                <td>Nama Program Studi Tujuan</td>
                <td>:</td>
                <td>{{ $mbkm->studentSwap->nama_prodi }}</td>
            </tr>
            <tr>
                <td>Nama Matkul</td>
                <td>:</td>
                <td>
                    <table>
                        @foreach ($mbkm->studentSwap->matkulSwap as $item)
                            <tr><td>{{ $item->matkul }}</td></tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endif
    </table>
</body>
</html>