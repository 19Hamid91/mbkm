@extends('layouts.app')
@section('tl')
    Dashboard Pembimbing
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
                                                <a href="#" data-id="{{ $item->id }}" id="detail_peng"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalDetail">{{ $item->mahasiswa->nama . '(' . $item->mahasiswa->nim . ')' }}</a>
                                            </td>
                                            <td>
                                                @if ($item->dosen != null)
                                                    {{ $item->dosen->nama }}
                                                @else
                                                    <div class="badge badge-danger">
                                                        Dosen belum diinput
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->jenis_mbkm == 'in')
                                                    MBKM Luar Polines
                                                @else
                                                    MBKM Dalam Polines
                                                @endif
                                            </td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>
                                                <center>
                                                    @if ($item->status == 'WAITING')
                                                        <div class="badge badge-warning"><b>Menunggu</b></div>
                                                    @elseif($item->status == 'AKTIF')
                                                        <div class="badge badge-success"><b>Aktif</b></div>
                                                    @elseif($item->status == 'PASS')
                                                        <div class="badge badge-secondary"><b>Selesai</b></div>
                                                    @endif
                                                </center>
                                            </td>
                                            <td style="width: 10%">
                                                @php
                                                    // $getData=\App\Models\Mbkm::where([['tahun', date('Y')], ['dosen_id', Auth::user()->dosen->id]])->whereNot('status', 'PASS')->first();
                                                    $dateMin = $item->durasi - 1;
                                                    $duration = '+ ' . $dateMin . ' month';
                                                    // return $duration;
                                                    // echo $duration;
                                                    $getDateLast = date('Y-m-d', strtotime($duration, strtotime($item->updated_at)));
                                                    // echo $getDateLast;
                                                @endphp

                                                
                                                {{-- @if (date('Y-m-d') >= $getDateLast) --}}
                                                    @if ($item->nilai_dosbing == null)
                                                    <button type="button" class="btn btn-inverse-success"
                                                    data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-type="Dosen"
                                                    data-target="#exampleModalNilai"
                                                    data-url="/dosbing/nilai"
                                                    data-nama="{{ $item->mahasiswa->nama . ' (' . $item->mahasiswa->nim . ')' }}"
                                                    id="btn_nilai_dosen" style="padding: 10px"><b>Form Nilai</b></button>
                                                    @endif
                                                {{-- @endif --}}
                                                {{-- <button type="button" class="btn btn-inverse-success" data-id="{{ $item->id }}"
                                                    data-toggle="modal" data-target="#exampleModalLogbookPembimbing"
                                                    data-nama="{{ $item->mahasiswa->nama . ' (' . $item->mahasiswa->nim . ')' }}"
                                                    id="btn_report_dosen" style="padding: 10px">Logbook</button> --}}
                                                {{-- @if (date('Y-m-d H:i:s', strtotime('+1 month', strtotime($getDateLast))) >= $getDateLast)
                                                    <button data-id="{{ $item->report }}" id="btn_report_pem"
                                                        data-toggle="modal" data-target="#exampleModalReportPembimbing"
                                                        class="btn btn-inverse-danger" style="padding: 10px">Laporan</button>
                                                @endif --}}
                                                {{-- <button data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#exampleModal" id="show-file" type="button"
                                                    class="btn btn-inverse-info btn-md" style="padding: 10px"><i
                                                        class="ti-file"></i><b>Lihat File</b></button> --}}
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
        $("tr td #btn_nilai_dosen").on("click",function(){
            var id=$(this).data("id")
            var url=$(this).data("url")
            var nama=$(this).data("nama")
            var type=$(this).data("type")
            $("#type_nilai").text(type)
            $(".modal-body #id_mbkm_nilai").val(id)
            $("#form_nilai").attr("action",url)
            $("#exampleModalLabelNilai").html("Form Nilai "+nama)
        })
        $("tr td #acc").on("click", function() {
            var myBookId = $(this).data('id');
            console.log(myBookId);
            $(".modal-body #id_mbkm").val(myBookId);
            var getAttr = $(this).attr("data-id");
            var getNama = $(this).attr("data-name");
            var getRole = $(this).attr("data-role");
            // console.log(getAttr);
            if (getRole === "kaprodi") {

            } else {
                swal({
                        title: "Warning?",
                        text: "Anda Yakin Ingin Menyetujui Pengajuan \n" + getNama + " Ini?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch("/api/" + getRole + "/acc/" + getAttr).then((res) => res.json()).then(
                                result => {
                                    if (result.success === 1) {
                                        swal(result.message, {
                                            icon: "success",
                                        });
                                        setTimeout(() => {
                                            location.reload()
                                        }, 3000);
                                    }
                                })

                        }
                    });
            }
        })
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

            // console.log(url_var)
            fetch("/mbkm/show-support/" + getAttr).then((res) => res.json()).then((result) => {
                if (result.data.support.trans_nilai !== null) {
                    link_nilai.attr("href", url_var + "/img/support/nilai/" + result.data.support
                        .trans_nilai)
                    label_nilai.html("Success")
                    label_nilai.addClass("badge badge-success");
                } else {
                    link_nilai.css("display", "none")
                    label_nilai.html("Pending")
                    label_nilai.addClass("badge badge-danger");
                }
                if (result.data.support.rekom_pt_asal !== null) {
                    link_rekom.attr("href", url_var + "/img/support/rekom/" + result.data.support
                        .rekom_pt_asal)
                    label_rekom.html("Success")
                    label_rekom.addClass("badge badge-success");
                } else {
                    link_rekom.css("display", "none")
                    label_rekom.html("Pending")
                    label_rekom.addClass("badge badge-danger");
                }

                if (result.data.support.pers_ortu !== null) {
                    link_ortu.attr("href", url_var + "/img/support/ortu/" + result.data.support
                        .pers_ortu)
                    label_ortu.html("Success")
                    label_ortu.addClass("badge badge-success");
                } else {
                    link_ortu.css("display", "none")
                    label_ortu.html("Pending")
                    label_ortu.addClass("badge badge-danger");
                }
                if (result.data.support.pakta_integritas !== null) {
                    link_pakta.attr("href", url_var + "/img/support/pakta/" + result.data.support
                        .pakta_integritas)
                    label_pakta.html("Success")
                    label_pakta.addClass("badge badge-success");
                } else {
                    link_pakta.css("display", "none")
                    label_pakta.html("Pending")
                    label_pakta.addClass("badge badge-danger");
                }
                if (result.data.support.ket_sehat !== null) {
                    link_sehat.attr("href", url_var + "/img/support/sehat/" + result.data.support
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
            var loading = $("#loading-detail")
            var tbl = $("#tbl-detail")
            var myBookId = $(this).data('id');
            fetch("/api/mbkm/info/" + myBookId).then((res) => res.json()).then(result => {
                loading.css("display", "none")
                tbl.css("display", "block")
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
                    $("#status_tbl").addClass("badge badge-secondary")
                    $("#status_tbl b").html(result.data.status)
                }
                $("#lembaga_tbl").html(result.data.nama_lembaga)
                $("#durasi_tbl").html(result.data.durasi + " Bulan")
                $("#rincian_id").html(result.data.rincian)
                $("#dosen_tbl").html(result.data.dosen.nama)
                $("#pemEx_tbl").html(result.data.pem_ex.nama)
                // console.log();
                $(".tr_swap_student").remove()
                // $.each(collection, function (indexInArray, valueOfElement) { 

                // });
                if (result.data.type_program.id == 8) {
                    $("#studen_swap_tbl").css("display", "block")

                    $("#per_prodi").html(result.data.student_swap.nama_prodi)
                    result.data.student_swap.matkul_swap.forEach(element => {
                        $("#tbl_student_swap").append("<tr class='tr_swap_student'><td>" + element
                            .matkul + "</td></tr>")
                    });
                } else if (result.data.type_program.id == 5) {
                    $("#kkn_tbl").css("display", "block")
                }
            });
        });

        $("tr td #btn_report_dosen").click(function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id")
            var nama = $(this).attr("data-nama")
            $("#mbkm_id").val(id)
            $("#nama_peserta").html(nama)
            // console.log(id);
            $(".trtr_logbook").remove()
            fetch("/api/dosbing/logbook/" + id).then((res) => res.json()).then(result => {
                result.data.forEach(element => {
                    const date = new Date(element.created_at);
                    const date_fix = new Intl.DateTimeFormat(["ban", "id"], {
                        dateStyle: "full",
                        timeStyle: "long",
                        timeZone: "Asia/Jakarta",
                    }).format(date)
                    $(".tbl_logbook").append(
                        "<tr style='border-bottom: 1pt solid black;'  class='trtr_logbook'><td style='width:30%'>" +
                        date_fix + "</td><td>" + element.body + "</td></tr>")
                });
            })
        });
        $("tr td #btn_report_pem").click(function(e) {
            var id = $(this).attr("data-id")
            // console.log(id);
            $("#show-pdf").attr("data", "/img/report/" + id);
        })
        $("#acc_logbook_dosbing").click(function(e) {
            var id = $("#mbkm_id").val()
            swal({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menyetujui Logbook?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/dosbing/logbook/" + id + "/acc").then((res) => res.json()).then(result => {
                            if (result.success === 1) {
                                swal(result.message, {
                                    icon: "success",
                                });
                                // setTimeout(() => {
                                //     location.reload()
                                // }, 3000);
                            }
                        })


                    }
                });


            // console.log(id);
        })
    </script>
@endsection
