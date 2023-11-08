<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pakta Integritas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .content {
            font-family: 'Times New Roman', Times, serif;
            font-weight: 350;
            font-size: 16px;
            margin-left: 2cm;
            margin-right: 1cm;
            text-align: justify;
            line-height: 1.2;
        }
        table {
            margin: 0;
            padding: 0;
            table-layout: auto;
        }
        .header {
            margin-left: 0;
            font-size: 14px;
        }
        ol{
            padding-left: 1.4em;
        }
    </style>
</head>
<body>
    <div class="header">
    <center>
        <h5>
            Surat Pakta Integritas<br>Calon Peserta Mahasiswa Merdeka Belajar Politeknik Negeri Semarang<br>Tahun {{ date('Y') }}
        </h5>
    </center>
    </div>
    <br>
<div class="content">
    <table>
        <tr>
            <td style="width:100%">Yang bertanda tangan di bawah ini:</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td colspan="20"></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td colspan="20"></td>
        </tr>
        <tr>
            <td>Perguruan Tinggi</td>
            <td>:</td>
            <td colspan="20">Politeknik Negeri Semarang</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td colspan="20"></td>
        </tr>
    </table>
    <br>
    <p>Dengan ini menyatakan kesanggupan mengikuti program Merdeka Belajar Politeknik Negeri Semarang tahun {{ date('Y') }} dengan ketentuan sebagai berikut:</p>
    <ol>
        <li>
            Saya bersedia untuk menerima jadwal perkuliahan yang akan ditentukan oleh Politeknik Negeri Semarang. Jika saya menolak keputusan tersebut, maka saya bersedia untuk tidak dapat mendaftar program Merdeka Belajar Politeknik Negeri Semarang berikutnya.
        </li>
        <li>
            Mentaati seluruh ketentuan program Merdeka Belajar Politeknik Negeri Semarang dalam peraturandan kebijakan Polteknik Negeri Semarang.
        </li>
        <li>
            Berkomitmen dengan sungguh-sungguh untuk menyelesaikan rangkaian program dari awal hingga selesai.
        </li>
        <li>
            Selama mengikuti program Merdeka Belajar Politeknik Negeri Semarang, saya bersedia mematuhi segala peraturan akademik dan kode etik mahasiswa yang berlaku di Politeknik Negeri Semarang, maka saya akan menerima sanksi sesuai dengan ketentuan yang berlaku.

        </li>
    </ol>
    <br>
    <p>Demikian surat pernyataan ini dibuat dengan sebenarnya tanpa ada paksaan dari pihak manapun dan apabila dikemudian hari saya mengingkari pernyataan ini, saya bersedia menerima sanksi dengan ketentuan yang berlaku.</p>
<br><br><br>
    <div class="float-right">
        <p style="text-align: right">Semarang, {{  date('d-m-Y') }}</p>
        <br>
        <br>
        <small>TTD<br>Rp.10.000</small>
        <br>
        <br>
        <p style="text-align: right">.........................</p>
    </div>
</div>
</body>
</html>