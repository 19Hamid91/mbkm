@extends('layouts.app')
@section('tl')
    @if (Auth::user()->role=="KAPRODI")
        Dashboard Kaprodi
    @elseif(Auth::user()->role=="KAJUR")
        Dashboard Kajur
    @endif
@endsection
@section('content')
<style>.swal-modal .swal-text {
    text-align: center;
}</style>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pengajuan MBKM
                        <p class="card-description">
                            Setujui Pengajuan
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

                        {{-- @if (Auth::user()->role=="KAPRODI")
                            <a href="/exportprodi" data-id="" id="export" type="button"
                                class="btn btn-inverse-success btn-md float-right" ><b>Export</b>
                            </a>
                        @elseif(Auth::user()->role=="KAJUR")
                            <a href="/exportkajur" data-id="" id="export" type="button"
                                class="btn btn-inverse-success btn-md float-right" ><b>Export</b>
                            </a>
                        @endif --}}

                        

                        <div class="table-responsive">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama (nim)</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Jenis MBKM</th>
                                        <th>Tahun</th>
                                        <th>Status MBKM</th>
                                        <th>Aksi</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kaprodi as $item)
                                    
                                        <tr>
                                            <td>
                                                <a href="#" data-id="{{ $item->id }}" id="detail_peng" data-toggle="modal"
                                                        data-target="#exampleModalDetail">{{ $item->mahasiswa->nama . '(' . $item->mahasiswa->nim . ')' }}</a>
                                            </td>
                                            <td>@if ($item->dosen!=null)
                                                {{ $item->dosen->nama}}
                                            @else
                                                <div class="badge badge-danger">
                                                    Dosen belum diinput
                                                </div>
                                            @endif</td>
                                            <td>
                                                @if ($item->jenis_mbkm == 'in')
                                                    MBKM Dalam Polines
                                                @else
                                                    MBKM Luar Polines
                                                @endif
                                            </td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>@if ($item->status=="WAITING")
                                                <div class="badge badge-warning">Menunggu</div>
                                            @elseif($item->status=="AKTIF")
                                                <div class="badge badge-success">Aktif</div>
                                            @elseif($item->status=="PASS")
                                                <div class="badge badge-danger">Pass</div>
                                            @endif</td>
                                            <td style="width: 10%">
                                                @if (Request::is('kaprodi'))
                                                @if ( $item->pers_kaprodi == null)
                                                    <button data-id="{{ $item->id }}" data-name="{{ $item->mahasiswa->nama }}"  data-role="kaprodi" id="acc" type="button"
                                                    class="btn btn-inverse-success btn-md" style="padding: 10px"><i
                                                    class="ti-check"></i><b>Setujui</b></button> 
                                                @endif
                                                @if ( $item->dosen_id == null)
                                                    <button type="button" id="setdosbing" class="btn btn-inverse-warning btn-md"
                                                    data-id="{{ $item->id }}" data-nama="{{ $item->mahasiswa->nama }}" data-role=@if(Request::is('kajur'))"kajur"
                                                    @elseif(Request::is('kaprodi'))"kaprodi"
                                                    @elseif (Request::is('pimpinan'))"pimpinan"
                                                    @endif data-toggle="modal" data-target="#exampleModalKaprodi" data-name="{{ $item->mahasiswa->nama }}" style="padding: 10px"><i
                                                        class="ti-user"></i><b>Set Dosbing</b></button>
                                                @endif
                                                @elseif(Request::is('kajur'))
                                                @if ( $item->pers_kajur == null)
                                                    <button type="button" id="acc" class="btn btn-inverse-success btn-md"
                                                    data-id="{{ $item->id }}" data-role=@if(Request::is('kajur'))"kajur"
                                                    @elseif(Request::is('kaprodi'))"kaprodi"
                                                    @elseif (Request::is('pimpinan'))"pimpinan"
                                                    @endif data-name="{{ $item->mahasiswa->nama }}" style="padding: 10px"><i
                                                        class="ti-check"></i><b>Setujui</b></button>
                                                @endif
                                                @endif
                                                <button data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#exampleModal" id="show-file" type="button"
                                                    class="btn btn-inverse-info btn-md" style="padding: 10px"><i
                                                        class="ti-file"></i><b>Lihat File</b></button>
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Mahasiswa MBKM
                        @if (Auth::user()->role=="KAPRODI")
                            <a href="" data-id="" id="export" type="button"
                                class="btn btn-inverse-success btn-md float-right" data-toggle="modal" data-target="#exampleModalFilterExport"><b>Export</b>
                            </a>
                        @elseif(Auth::user()->role=="KAJUR")
                            <a href="" data-id="" id="export" type="button"
                                class="btn btn-inverse-success btn-md float-right" data-toggle="modal" data-target="#exampleModalFilterExport"><b>Export</b>
                            </a>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama (nim)</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Jenis MBKM</th>
                                        <th>Tahun</th>
                                        <th>Status MBKM</th>
                                        <th>Nilai AKhir</th>
                                        <th>Aksi</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datamhs as $item)
                                    
                                        <tr>
                                            <td>
                                                <a href="#" data-id="{{ $item->id }}" id="detail_peng" data-toggle="modal"
                                                        data-target="#exampleModalDetail">{{ $item->mahasiswa->nama . '(' . $item->mahasiswa->nim . ')' }}</a>
                                            </td>
                                            <td>@if ($item->dosen!=null)
                                                {{ $item->dosen->nama}}
                                            @else
                                                <div class="badge badge-danger">
                                                    Dosen belum diinput
                                                </div>
                                            @endif</td>
                                            <td>
                                                @if ($item->jenis_mbkm == 'in')
                                                    MBKM Dalam Polines
                                                @else
                                                    MBKM Luar Polines
                                                @endif
                                            </td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>@if ($item->status=="WAITING")
                                                <div class="badge badge-warning">Menunggu</div>
                                            @elseif($item->status=="AKTIF")
                                                <div class="badge badge-success">Aktif</div>
                                            @elseif($item->status=="PASS")
                                                <div class="badge badge-danger">Pass</div>
                                            @endif</td>
                                            <td>{{ ($item->nilai_dosbing + $item->nilai_pemlap) / 2 }}</td>
                                            <td style="width: 10%">
                                                @if (Request::is('kaprodi'))
                                                @if ( $item->pers_kaprodi == null)
                                                    <button data-id="{{ $item->id }}" data-name="{{ $item->mahasiswa->nama }}"  data-role="kaprodi" id="acc" type="button"
                                                    class="btn btn-inverse-success btn-md" style="padding: 10px"><i
                                                    class="ti-check"></i><b>Setujui</b></button> 
                                                @endif
                                                @if ( $item->dosen_id == null)
                                                    <button type="button" id="setdosbing" class="btn btn-inverse-warning btn-md"
                                                    data-id="{{ $item->id }}" data-nama="{{ $item->mahasiswa->nama }}" data-role=@if(Request::is('kajur'))"kajur"
                                                    @elseif(Request::is('kaprodi'))"kaprodi"
                                                    @elseif (Request::is('pimpinan'))"pimpinan"
                                                    @endif data-toggle="modal" data-target="#exampleModalKaprodi" data-name="{{ $item->mahasiswa->nama }}" style="padding: 10px"><i
                                                        class="ti-user"></i><b>Set Dosbing</b></button>
                                                @endif
                                                @elseif(Request::is('kajur'))
                                                @if ( $item->pers_kajur == null)
                                                    <button type="button" id="acc" class="btn btn-inverse-success btn-md"
                                                    data-id="{{ $item->id }}" data-role=@if(Request::is('kajur'))"kajur"
                                                    @elseif(Request::is('kaprodi'))"kaprodi"
                                                    @elseif (Request::is('pimpinan'))"pimpinan"
                                                    @endif data-name="{{ $item->mahasiswa->nama }}" style="padding: 10px"><i
                                                        class="ti-check"></i><b>Setujui</b></button>
                                                @endif
                                                @endif
                                                <button data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#exampleModal" id="show-file" type="button"
                                                    class="btn btn-inverse-info btn-md" style="padding: 10px"><i
                                                        class="ti-file"></i><b>Lihat File</b></button>
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
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $("tr td #acc").on("click", function() {
            var myBookId = $(this).data('id');
            console.log(myBookId);
            $(".modal-body #id_mbkm").val( myBookId );
            var getAttr = $(this).attr("data-id");
            var getNama = $(this).attr("data-name");
            var getRole = $(this).attr("data-role");
            console.log(getRole);
                swal({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menyetujui Pengajuan \n"+getNama+" Ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/"+getRole+"/acc/"+getAttr).then((res)=>res.json()).then(result=>{
                            console.log("fetch")
                            if(result.success===1){
                                console.log("scs")
                                swal(result.message, {
                                    icon: "success",
                                });
                                setTimeout(() => {
                                    location.reload()
                                }, 2000);
                            }
                        })
                        
                    }
                });
        })
        $("tr td #setdosbing").on("click", function(e) {
            var id_mbkm = $(this).data('id')
            var namamhs = $(this).data('nama')
            const words = namamhs.toLowerCase().split(" ");
            
            for (let i = 0; i < words.length; i++) {
                words[i][0].toLowerCase()
                words[i] = words[i][0].toUpperCase() + words[i].substr(1);
            }
            e.preventDefault()
            $('#titleSetDosbing').text('Set Dosen Pembimbing untuk '+ words.join(' '));
            $('#id_mbkm').val(id_mbkm);
        })
        $("tr td #show-file").on("click", function() {
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
            
            const url_var = window.location.origin;
            fetch("/mbkm/show-support/" + getAttr).then((res) => res.json()).then((result) => {
                if (result.data.portofolio !== null) {
                    link_portofolio.attr("href", url_var+"/img/support/portofolio/" + result.data.portofolio)
                    label_portofolio.html("Success")
                    label_portofolio.addClass("badge badge-success");
                } else {
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
        $("tr td #detail_peng").click(function (e) { 
            e.preventDefault();
            var loading=$("#loading-detail")
            var tbl=$("#tbl-detail")
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
                $("#rincian_id").html(result.data.rincian)
                if(result.data.dosen!==null){
                    $("#dosen_tbl").html(result.data.dosen.nama)
                }if(result.data.pem_ex!==null){
                    $("#pemEx_tbl").html(result.data.pem_ex.nama)
                }
                $(".tr_swap_student").remove()
                $(".tr_kkn_member").remove()
                // console.log();
                // $.each(collection, function (indexInArray, valueOfElement) { 
                     
                // });
                if(result.data.type_program.id==8){
                    $("#studen_swap_tbl").css("display","block")
                    $("#knn_tbl").css("display","none")
                    $("#per_prodi").html(result.data.student_swap.nama_prodi)
                    result.data.student_swap.matkul_swap.forEach(element => {
                        $("#tbl_student_swap").append("<tr class='tr_swap_student'><td>"+element.matkul+"</td></tr>")
                    });
                }else if(result.data.type_program.id==5){
                    $("#knn_tbl").css("display","block")
                    $("#kkn_jumlah").html(result.data.kkn.jumlah_anggota)
                    $("#kkn_dana_tbl").html(result.data.kkn.pendanaan)
                    $("#studen_swap_tbl").css("display","none")
                    result.data.kkn.kkn_member.forEach(element => {
                        $("#kkn_mahasiswa").append("<tr class='tr_kkn_member'><td>"+element.nama+"</td></tr>")
                    });
                }
            });
        });
    </script>
@endsection
