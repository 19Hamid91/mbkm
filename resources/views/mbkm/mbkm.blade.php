@extends('layouts.app')
@section('tl')
    MBKM
@endsection
@section('content')
<style>
    th, td {
  padding: 5px;
}
</style>
    <img style="position:absolute; left:0; right:0; margin:0 auto;z-index:1;max-width:10%;height:auto;display:none;" id="loading" src="{{ asset('img/loading.gif')}}" alt="Loading..." />
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pendaftaran yang telah diajukan
                        {{ Request::is('mbkm/out') ? ' luar Polines' : 'dalam Polines' }}</h4>
                    <p class="card-description">
                        Pendaftaran MBKM
                    </p>
                    @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('success') }}
                        </div>
                    @elseif(session('fail'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('fail') }}
                        </div>
                        @endif
                        <a id="daftarMbkm" type="button" class="btn btn-inverse-primary btn-icon-text mb-3 float-right"
                        href="/mbkm/regis">
                        <i class="ti-upload btn-icon-prepend"></i>
                        <b>Daftar MBKM</b>
                    </a>
                    @foreach ($mbkm as $item)
                    @if ($item->status == "AKTIF")
                    <a href="/mbkm/sk/{{ $item->id }}" type="button" class="btn btn-primary btn-icon-text mb-3 mr-1 float-right" target="_blank">
                        <i class="ti-download btn-icon-prepend"></i>
                        <b>SK</b>
                    </a>
                    @endif
                    @endforeach
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Pembimbing Lapangan</th>
                                    <th>Progress Formulir</th>
                                    <th>Progress Persetujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    {{-- <th>Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mbkm as $item)
                                    <tr>
                                        <td style="width: 20%"><a href="/mbkm/save/{{ $item->id }}" target="_blank"><h5><b>{{ $item->mahasiswa->nama }}</b></h5></a></td>
                                       <td>
                                        @if ($item->dosen!=null)
                                            <b>{{ $item->dosen->nama }}</b>
                                        @else
                                        <div class="badge badge-danger">Dosen Belum diset</div>
                                        @endif
                                       </td>
                                       <td>
                                        @if ($item->dosbingex!=null)
                                            <b>{{ $item->dosbingex->nama }}</b>
                                        @else
                                        <div class="badge badge-danger">Pemlap Belum diset</div>
                                        @endif
                                       </td>
                                       @php
                                            $nilaiPers = 0;
                                            $nilaiForm = 0;
                                        @endphp
                                        @php
                                            if ($item->pers_kaprodi == 'Y') {
                                                $nilaiPers += 50;
                                            }
                                            if ($item->pers_kajur == 'Y') {
                                                $nilaiPers += 50;
                                            }
                                            // echo ($item->support->pakta_integritas);
                                            if ($item->support->trans_nilai) {
                                                $nilaiForm += 25;
                                            }
                                            if ($item->support->pakta_integritas) {
                                                $nilaiForm += 25;
                                            }
                                            if ($item->support->rekom_pt_asal != null) {
                                                $nilaiForm += 25;
                                            }
                                            if ($item->support->pers_ortu != null) {
                                                $nilaiForm += 25;
                                            }
                                            if ($item->support->ket_sehat != null) {
                                                $nilaiForm += 0;
                                            }
                                        @endphp
                                        {{-- {{ $item->support }} --}}
                                        <td style="width: 30%" align="center">
                                            <a href="#" data-id="{{ $item->id }}" id="show-form"
                                                data-toggle="modal" data-target="#exampleModal">
                                                {{-- <div class="row"> --}}
                                                    {{-- <div class="col-md-1"> --}}
                                                        <center>
                                                            <span class="font-weight-bold"
                                                                style="">{{ $nilaiForm }}%</span> <br>
                                                        </center>
                                                    {{-- </div> --}}
                                                    {{-- <div class="col-md-9 "> --}}
                                                        <div class="progress progress-md"
                                                            style="width: 100%">
                                                            <div class="progress-bar @php
                                                                if ($nilaiForm==20) {
                                                                    echo 'bg-danger';
                                                                } elseif($nilaiForm==40) {
                                                                    echo 'bg-warning';
                                                                }elseif($nilaiForm==60){
                                                                    echo 'bg-info';
                                                                }
                                                                elseif($nilaiForm==80){
                                                                    echo 'bg-secondary';
                                                                }elseif($nilaiForm==100){
                                                                    echo 'bg-success';
                                                                } @endphp"
                                                                role="progressbar" style="width: {{ $nilaiForm }}%"
                                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    {{-- </div> --}}
                                                </div>
                                            </a>
                                        </td>
                                        <td style="width: 30%" align="center">
                                            <a href="#" data-id="{{ $item->id }}" id="show-pers"
                                                data-toggle="modal" data-target="#exampleModalPers">

                                                {{-- <div class="row"> --}}
                                                    {{-- <div class="col-md-1"> --}}
                                                        <center>
                                                            <span class="font-weight-bold"
                                                                style=""><b>{{ $nilaiPers }}</b>%</span>
                                                        </center>
                                                    {{-- </div>
                                                    <div class="col-md-9"> --}}
                                                        <center>
                                                            <div class="progress progress-md"
                                                                style="width:90%">
                                                                <div class="progress-bar
                                                                @php
                                                            if ($nilaiPers==50) {
                                                                    echo 'bg-warning';
                                                                } elseif($nilaiPers==100) {
                                                                    echo 'bg-success';
                                                                } @endphp"
                                                                    role="progressbar" style="width: {{ $nilaiPers }}%"
                                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </center>
                                                    {{-- </div> --}}
                                                {{-- </div> --}}
                                            </a>


                                        </td>
                                        <td>
                                            @if ($item->status == 'WAITING')
                                                <div class="badge badge-warning">Menunggu</div>
                                            @elseif($item->status == 'AKTIF')
                                                <div class="badge badge-success">Aktif</div>
                                            @elseif($item->status == 'PASS')
                                                <div class="badge badge-warning">Pass</div>
                                            @endif
                                        </td>
                                        <td style="width: 10%">
                                            <button type="button" class="btn btn-inverse-info btn-md" id="detail_peng" style="padding: 10px" data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#exampleModalDetail"><b>Detail</b></button>
                                                {{-- <a href="" class="btn btn-inverse-github" style="padding: 10px">Save</a> --}}
                                            @if (
                                                $item->support->trans_nilai == null ||
                                                    $item->support->pakta_integritas == null ||
                                                    $item->support->pakta_integritas == null ||
                                                    $item->support->pers_ortu == null )
                                                <a type="button" class="btn btn-inverse-success btn-md"
                                                    href="/mbkm/support/{{ $item->id }}?t={{ Request::is('mbkm/out') ? 'out' : 'in' }}"
                                                    style="padding: 10px"><b>Lengkapi</b></a>
                                            @elseif($item->status == 'AKTIF')
                                                @php
                                                    $getLogbook = \App\Models\Logbook::whereDate('created_at', date('Y-m-d'))
                                                        ->whereHas('mbkm', function ($query) use ($item) {
                                                            $query->where([['id', $item->id], ['status', 'AKTIF']]);
                                                        })
                                                        ->first();
                                                @endphp
                                                @php
                                                    $minDate=$item->durasi-1;
                                                    $duration = '+ ' . $minDate . ' month';
                                                    $getDateLast = date('Y-m-d', strtotime($duration, strtotime($item->date_pers)));
                                                    // echo $getDateLast;
                                                @endphp
                                                @if ($item->dosbingex_id==null)
                                                    {{-- @if (date('Y-m-d')>=$getDateLast) --}}
                                                        <button type="button" class="btn btn-inverse-primary btn-md" id="create_dosbing_ex"
                                                        data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#exampleModalPemlab"
                                                        style="padding: 10px"><b>Pembimbing Lapangan</b></button>
                                                    {{-- @endif --}}
                                                @endif
                                                {{-- @if ($getLogbook == null)
                                                    <button type="button" class="btn btn-inverse-primary btn-md" id="logbook"
                                                        data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#exampleModalLogbook"
                                                        style="padding: 10px"><b>Logbook</b></button>
                                                @endif --}}
                                                {{-- @if ($item->report==null)
                                                    <button type="button" class="btn btn-inverse-inverse-danger btn-md" id="report"
                                                    data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#exampleModalLaporan"
                                                    style="padding: 10px"><b>Laporan</b></button>
                                                @endif --}}
                                            {{-- @elseif (
                                                $item->support->trans_nilai != null &&
                                                    $item->support->pakta_integritas != null &&
                                                    $item->support->pers_ortu != null &&
                                                    $item->support->ket_sehat != null)
                                                <button type="button" class="btn btn-inverse-info btn-md" id="form"
                                                    data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#exampleModalForm"
                                                    style="padding: 10px"><b>Form</b></button> --}}
                                            @endif
                                        </td>
                                        {{-- <td><label class="badge badge-danger">Pending</label></td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($mbkm as $item)
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h4 class="card-title">Nilai</h4>
                        </center>
                        <table id="nilai">
                            <tr>
                                <td style="width: 50%">{{ $item->dosen_id!=null ? $item->dosen->nama : "Dosen Pembimbing"}}</td>
                                <td style="width: 1%">:</td>
                                <td id="nilai_dosbing">{{ $item->nilai_dosbing != null ? $item->nilai_dosbing : "-"}}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">{{ $item->dosbingex != null ? $item->dosbingex->nama : "Pembimbing Lapangan" }}</td>
                            <td style="width: 1%">:</td>
                            <td id="nilai_pemlap">{{ $item->nilai_pemlap != null ?  $item->nilai_pemlap : "-" }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%"><strong>Nilai Akhir</strong></td>
                            <td style="width: 1%"><strong>:</strong></td>
                            <td id="nilai_akhir"><strong>-</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script>
        $( document ).ready(function() {
            $('#loading').hide();
            var nd = $('#nilai_dosbing').text()
            var np = $('#nilai_pemlap').text()
            nd = nd === "-" ? 0 : parseInt(nd)
            np = np === "-" ? 0 : parseInt(np)
            var na = 0
            if (nd == 0 || np == 0) {
                na = "-"
            } else {
                na = (nd + np) / 2
            }
            var simbol = "-"
            if (na >= 90) {
                simbol = "A"
            } else if (na >= 80 && na < 90){
                simbol = "AB"
            } else if (na >= 70 && na < 80){
                simbol = "B"
            } else if (na >= 60 && na < 70){
                simbol = "C"
            } else if (na < 60){
                simbol = "D"
            }
            // console.log(na);
            $('#nilai_akhir').text(na+" / "+simbol)
        });
        $('#daftarMbkm').on('click', function(){
            $('#loading').show();
        })
        $(window).bind("pageshow", function(event) {
            $("#loading").hide();
        });
            </script>
    <script>
        $("tr td #show-form").on("click", function() {
            var getAttr = $(this).attr("data-id");
            var link_sehat = $("#link_sehat")
            var link_ortu = $("#link_ortu")
            var link_rekom = $("#link_rekom")
            var link_pakta = $("#link_pakta")
            var link_nilai = $("#link_nilai")
            var link_portofolio = $("#link_portofolio")
            var label_sehat = $("#label_sehat")
            var label_ortu = $("#label_ortu")
            var label_rekom = $("#label_rekom")
            var label_pakta = $("#label_pakta")
            var label_nilai = $("#label_nilai")
            var label_portofolio = $("#label_portofolio")
            
            var tr_portofolio = $("#tr_portofolio")
            const url_var = window.location.origin;
            // console.log(url_var)
            fetch("/mbkm/show-support/" + getAttr).then((res) => res.json()).then((result) => {
                if (result.data.portofolio !== null) {
                    link_portofolio.attr("href", url_var+"/img/support/portofolio/" + result.data.portofolio)
                    label_portofolio.html("Success")
                    label_portofolio.addClass("badge badge-success");
                } else {
                    tr_portofolio.css("display", "none")
                    link_portofolio.css("display", "none")
                    label_portofolio.html("Pending")
                    label_portofolio.addClass("badge badge-danger");
                }
                if (result.data.support.trans_nilai !== null) {
                    link_nilai.attr("href", url_var+"/img/support/nilai/" + result.data.support
                        .trans_nilai)
                    label_nilai.html("Success")
                    label_nilai.addClass("badge badge-success");
                } else {
                    link_nilai.css("display", "none")
                    label_nilai.html("Pending")
                    label_nilai.addClass("badge badge-danger");
                }
                if (result.data.support.rekom_pt_asal !== null) {
                    link_rekom.attr("href", url_var+"/img/support/rekom/" + result.data.support
                        .rekom_pt_asal)
                    label_rekom.html("Success")
                    label_rekom.addClass("badge badge-success");
                } else {
                    link_rekom.css("display", "none")
                    label_rekom.html("Pending")
                    label_rekom.addClass("badge badge-danger");
                }

                if (result.data.support.pers_ortu !== null) {
                    link_ortu.attr("href", url_var+"/img/support/ortu/" + result.data.support
                        .pers_ortu)
                    label_ortu.html("Success")
                    label_ortu.addClass("badge badge-success");
                } else {
                    link_ortu.css("display", "none")
                    label_ortu.html("Pending")
                    label_ortu.addClass("badge badge-danger");
                }
                if (result.data.support.pakta_integritas !== null) {
                    link_pakta.attr("href", url_var+"/img/support/pakta/" + result.data.support
                        .pakta_integritas)
                    label_pakta.html("Success")
                    label_pakta.addClass("badge badge-success");
                } else {
                    link_pakta.css("display", "none")
                    label_pakta.html("Pending")
                    label_pakta.addClass("badge badge-danger");
                }
                if (result.data.support.ket_sehat !== null) {
                    link_sehat.attr("href", url_var+"/img/support/sehat/" + result.data.support
                        .ket_sehat)
                    label_sehat.html("Success")
                    label_sehat.addClass("badge badge-success");
                } else {
                    link_sehat.css("display", "none")
                    label_sehat.html("Pending")
                    label_sehat.addClass("badge badge-danger");
                }
            })
        });
        $("tr td #show-pers").on("click", function() {
            var getAttr = $(this).attr("data-id");
            var label_karprodi = $("#label_kaprodi")
            var label_kajur = $("#label_kajur")
            var label_direktur = $("#label_direktur")
            fetch("/mbkm/show-support/" + getAttr).then((res) => res.json()).then((result) => {
                if (result.data.pers_kaprodi !== null) {
                    label_karprodi.html("Success")
                    label_karprodi.addClass("badge badge-success");
                } else {
                    // link_nilai.css("display", "none")
                    label_karprodi.html("Pending")
                    label_karprodi.addClass("badge badge-danger");
                }
                if (result.data.pers_kajur !== null) {
                    // link_rekom.attr("href", "http://appmbkm.test/img/support/rekom/" + result.data.support
                    //     .rekom_pt_asal)
                    label_kajur.html("Success")
                    label_kajur.addClass("badge badge-success");
                } else {
                    // link_rekom.css("display", "none")
                    label_kajur.html("Pending")
                    label_kajur.addClass("badge badge-danger");
                }

                // if (result.data.pers_direktur !== null) {
                    // link_ortu.attr("href", "http://appmbkm.test/img/support/ortu/" + result.data.support
                    //     .pers_ortu)
                //     label_direktur.html("Success")
                //     label_direktur.addClass("badge badge-success");
                // } else {
                //     // link_ortu.css("display", "none")
                //     label_direktur.html("Pending")
                //     label_direktur.addClass("badge badge-danger");
                // }
            })
        });
    </script>
    <script>
         $('tr td #form').on('click', function() {
            var myBookId = $(this).data('id');
            // console.log(myBookId);
            $(".modal-body #id_form").val(myBookId);
            console.log(myBookId);
        })
         $('tr td #create_dosbing_ex').on('click', function() {
            var myBookId = $(this).data('id');
            // console.log(myBookId);
            $(".modal-body #id_dosen_ex").val(myBookId);
            console.log(myBookId);
        })
        $("tr td #detail_peng").click(function (e) { 
            var loading=$("#loading-detail")
            var tbl=$("#tbl-detail")
            e.preventDefault();
            var myBookId = $(this).data('id');
            fetch("/api/mbkm/info/"+myBookId).then((res)=>res.json()).then(result=>{
                loading.css("display","none")
                tbl.css("display","block")
                $("#nama_tbl").html(result.data.mahasiswa.nama)
                $("#tahun_tbl").html(result.data.tahun)
                $("#prodi_tbl").html(result.data.prodi)
                $("#jenis_tbl").html(result.data.type_program.nama)
                $("#alasan_tbl").html(result.data.alasan)
                if(result.data.status==="WAITING"){
                    $("#status_tbl").addClass("badge badge-warning")
                    $("#status_tbl b").html(result.data.status)
                }else if(result.data.status==="AKTIF"){
                    $("#status_tbl").addClass("badge badge-success")
                    $("#status_tbl b").html(result.data.status)
                }else if(result.data.status==="PASS"){
                    $("#status_tbl").addClass("badge badge-danger")
                    $("#status_tbl b").html(result.data.status)
                }
                $("#lembaga_tbl").html(result.data.nama_lembaga)
                $("#durasi_tbl").html(result.data.durasi+" Bulan")
                // $("#tgl_mulai").html(result.data.tanggal_awal)
                // $("#tgl_selesai").html(result.data.tanggal_akhir)
                $("#rincian_id").html(result.data.rincian)
                
                if(result.data.dosen!==null){
                    $("#dosen_tbl").html(result.data.dosen.nama)
                }if(result.data.pem_ex!==null){
                    $("#pemEx_tbl").html(result.data.pem_ex.nama)
                }
                // console.log();
                $(".tr_swap_student").remove()
                $(".tr_kkn_member").remove()
                // $.each(collection, function (indexInArray, valueOfElement) { 
                     
                // });
                if(result.data.type_program.id==8){
                    $("#studen_swap_tbl").css("display","block")
                    
                    $("#per_prodi").html(result.data.student_swap.nama_prodi)
                    result.data.student_swap.matkul_swap.forEach(element => {
                        $("#tbl_student_swap").append("<tr class='tr_swap_student'><td>"+element.matkul+"</td></tr>")
                    });
                }else if(result.data.type_program.id==5){
                    $("#knn_tbl").css("display","block")
                    result.data.kkn.kkn_member.forEach(element => {
                        $("#kkn_mahasiswa").append("<tr class='tr_kkn_member'><td>"+element.nama+"</td></tr>")
                    });
                    $("#kkn_dana_tbl").text(result.data.kkn.pendanaan)
                    $("#kkn_jumlah").text(result.data.kkn.jumlah_anggota)
                }
            });
        });
    </script>
    <script>
        $('tr td #logbook').on('click', function() {
            var myBookId = $(this).data('id');
            // console.log(myBookId);
            $(".modal-body #id").val(myBookId);
            // console.log(myBookId);
        })
       
        $('tr td #report').on('click', function() {
            var myBookId = $(this).data('id');
            // console.log(myBookId);
            $(".modal-body #id_report").val(myBookId);
            console.log(myBookId);
        })
        
    </script>
    {{-- <script>
        const { jsPDF } =jspdf;

        // Default export is a4 paper, portrait, using millimeters for units
        const doc = new jsPDF();
        const image

        doc.
        doc.save("a4.pdf");
    </script> --}}
@endsection
