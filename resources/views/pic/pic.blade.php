@extends('layouts.app')
@section('tl')
    Dashboard
@endsection
@section('content')
    <style>
        .swal-modal .swal-text {
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pengajuan {{ $program->nama }}
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
                        <div class="table-responsive mt-3">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama (nim)</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Pembimbing Lapangan</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Nilai Dosbing</th>
                                        <th>Nilai Pemlap</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mbkm as $item)
                                        <tr>
                                            <td>
                                                <a href="#" data-id="{{ $item->id }}" id="detail_peng"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalDetail">{{ $item->mahasiswa->nama . '(' . $item->mahasiswa->nim . ')' }}</a>
                                            </td>
                                            <td>
                                                @if ($item->dosen != null)
                                                    {{ $item->dosen->nama }}
                                                @else
                                                    <div class="badge badge-danger">
                                                        Dosbing belum diinput
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->dosbingex != null)
                                                    {{ $item->dosbingex->nama }}
                                                @else
                                                    <div class="badge badge-danger">
                                                        Pemlap belum diinput
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>
                                                <center>
                                                    @if ($item->status == 'WAITING')
                                                        <div class="badge badge-warning">Menunggu</div>
                                                    @elseif($item->status == 'AKTIF')
                                                        <div class="badge badge-success">Aktif</div>
                                                    @elseif($item->status == 'PASS')
                                                        <div class="badge badge-danger">Pass</div>
                                                    @endif
                                                </center>
                                            </td>
                                            <td id="n_dosbing">{{ $item->nilai_dosbing ?? "-"  }}</td>
                                            <td id="n_pemlap">{{ $item->nilai_pemlap ?? "-" }}</td>
                                            <td>
                                                <a type="button" class="btn btn-success" id="nilai" data-idmbkm="{{ $item->id }}" data-ndosbing="{{ $item->nilai_dosbing }}" data-npemlap="{{ $item->nilai_pemlap }}" data-toggle="modal" data-target="#exampleModalPicNilai">Nilai</a>
                                                <a type="button" class="btn btn-primary" id="setSK" data-idmbkm="{{ $item->id }}" data-nosk="{{ $item->sk_direktur }}" data-ttd="{{ $item->pers_direktur }}" data-toggle="modal" data-target="#exampleModalSK">Set SK</a>
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
        $("tr td #show-file").on("click", function() {
            var getAttr = $(this).attr("data-id");
            var link_sehat = $("#link_sehat")
            var link_ortu = $("#link_ortu")
            var link_rekom = $("#link_rekom")
            var link_pakta = $("#link_pakta")
            var link_nilai = $("#link_nilai")
            var label_sehat = $("#label_sehat")
            var label_ortu = $("#label_ortu")
            var label_rekom = $("#label_rekom")
            var label_pakta = $("#label_pakta")
            var label_nilai = $("#label_nilai")
            const url_var = window.location.origin;

            fetch("/mbkm/show-support/" + getAttr).then((res) => res.json()).then((result) => {
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
        $("tr td #detail_peng").click(function(e) {
            e.preventDefault();
            var loading=$("#loading-detail")
            var tbl=$("#tbl-detail")
            var myBookId = $(this).data('id');
            fetch("/api/mbkm/info/" + myBookId).then((res) => res.json()).then(result => {
                loading.css("display","none")
                tbl.css("display","block")
                $("#nama_tbl").html(result.data.mahasiswa.nama)
                $("#tahun_tbl").html(result.data.tahun)
                $("#prodi_tbl").html(result.data.prodi)
                $("#jenis_tbl").html(result.data.type_program.nama)
                $("#alasan_tbl").html(result.data.alasan)
                if (result.data.status === "WAITING") {
                    $("#status_tbl").addClass("badge badge-warning")
                    $("#status_tbl b").html(result.data.status)
                } else if (result.data.status === "AKTIF") {
                    $("#status_tbl").addClass("badge badge-success")
                    $("#status_tbl b").html(result.data.status)
                } else if (result.data.status === "PASS") {
                    $("#status_tbl").addClass("badge badge-danger")
                    $("#status_tbl b").html(result.data.status)
                }
                $("#lembaga_tbl").html(result.data.nama_lembaga)
                $("#durasi_tbl").html(result.data.durasi + " Bulan")
                $("#rincian_id").html(result.data.rincian)
                // console.log();
                if(result.data.dosen!==null){
                    $("#dosen_tbl").html(result.data.dosen.nama)
                }if(result.data.pem_ex!==null){
                    $("#pemEx_tbl").html(result.data.pem_ex.nama)
                }
                $(".tr_swap_student").remove()
                $(".tr_kkn_member").remove()
                // $.each(collection, function (indexInArray, valueOfElement) { 

                // });
                if (result.data.type_program.id == 8) {
                    $("#studen_swap_tbl").css("display", "block")
                    $("#knn_tbl").css("display","none")
                    $("#per_prodi").html(result.data.student_swap.nama_prodi)
                    result.data.student_swap.matkul_swap.forEach(element => {
                        $("#tbl_student_swap").append("<tr class='tr_swap_student'><td>" + element
                            .matkul + "</td></tr>")
                    });
                } else if (result.data.type_program.id == 5) {
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
        $('#myTable').on('click', '#nilai', function(e){
            e.preventDefault()
            // var n_dosbing = parseInt($('#n_dosbing').text())
            // var n_pemlap = parseInt($('#n_pemlap').text())
            var id_mbkm = $(this).data('idmbkm')
            var n_dosbing = $(this).data('ndosbing')
            var n_pemlap = $(this).data('npemlap')
            
            console.log(id_mbkm,n_dosbing, n_pemlap)
            if(n_dosbing != ''){
                $('#nilai_dosbing').attr('readonly', true)
            }
            if(n_pemlap != ''){
                $('#nilai_pemlap').attr('readonly', true)
            }
            
            $('#id_mbkmpic').val(id_mbkm)
            $('#nilai_dosbing').val(n_dosbing)
            $('#nilai_pemlap').val(n_pemlap)
        })
        $('#myTable').on('click', '#setSK', function(e){
            e.preventDefault()
            var id_mbkm = $(this).data('idmbkm')
            var nosk = $(this).data('nosk')
            var ttd = $(this).data('ttd')
            if(nosk != ''){
                $('#nosk').attr('readonly', true)
            }
            // if(ttd != ''){
            //     $('#direktur_value').css('display', 'block')
            //     $('#select_direktur').css('display', 'none')
            // }
            $('#id_mbkmsk').val(id_mbkm)
            $('#nosk').val(nosk)
            $('#dirval').val(ttd)
            
            // var dropdown = document.getElementById("direktur");
            // for (var i = 0; i < dropdown.options.length; i++) {
            //     if (dropdown.options[i].value === ttd) {
            //         dropdown.options[i].selected = true;
            //         break;
            //     }
            // }
        })
    </script>
@endsection
