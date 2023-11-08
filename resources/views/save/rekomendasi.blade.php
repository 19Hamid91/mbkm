<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekomendasi</title>
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
            line-height: 1;
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
    </style>
</head>
<body>
    <div class="header">
    <table width="100%">
        <tr>
        <td width="20" align="center"><img src="{{ public_path('img/logo-mini.png')}}" width="100%"></td>
        <td width="100" align="center">
            <p><span style="font-size: 20px">KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI<br>
            <strong>POLITEKNIK NEGERI SEMARANG</strong></span><br>
            Jalan Prof. H. Soedarto, S.H. Tembalang, Semarang 50275, PO BOX 6199/SMS<br>Telephone (024)7473417, 7499585, 7499586, Facsimile (024)7472396<br><a style="text-decoration: underline;color: black;" href="http:/www.polines.ac.id">http:/www.polines.ac.id,</a> Email : sekretariat@polines.ac.id</p></td>
        </tr>
        </table>
    <hr>
    <center>
        <h4>
            SURAT REKOMENDASI
        </h4>
        <h5>
            No: 
        </h5>
    </center>
    </div>
    <br>
<div class="content">
    <table>
        <tr>
            <td colspan="42" style="width:100%">Saya yang bertandatangan di bawah ini:</td>
        </tr>
        <tr>
            <td style="width: 30%">Nama</td>
            <td style="width: 1%">:</td>
            <td colspan="20"></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td colspan="20"></td>
        </tr>
        <tr>
            <td>NIP/NIDN</td>
            <td>:</td>
            <td colspan="20"> / </td>
        </tr>
        <tr>
            <td colspan="42" style="width:100%">Dengan ini memberikan rekomendasi kepada mahasiswa</td>
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
            <td>Program Studi/Jurusan</td>
            <td>:</td>
            <td colspan="20"> / </td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>:</td>
            <td colspan="20">-</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td>-</td>
        </tr>
        <tr>
            <td>IPK</td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
    <br>
        <p style="margin-bottom: 0; padding-bottom: 0;">Untuk menjadi peserta program (tipe program) Politeknik Negeri Semarang.</p>
    
    <br>
    <p>Dengan ini kami juga menyatakan bahwa yang bersangkutan merupakan mahasiswa aktif pada (prodi), (jurusan) tahun akademik 000 dan memenuhi kriteria, syarat dan ketentuan yang berlaku dalam Politeknik Negeri Semarang.</p>

    <p>Demikian surat rekomendasi ini kami sampaikan untuk digunakan sebagaimana mestinya.</p>
    <br>
    <br>
    <div class="float-right">
        <p style="text-align: right">Semarang, {{  date('d-m-Y') }}</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p style="text-align: right">................................</p>
    </div>
</div>
</body>
</html>