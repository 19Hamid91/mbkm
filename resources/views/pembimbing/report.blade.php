@extends('layouts.app')
@section('tl')
    Laporan
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
                    <h4 class="card-title">Daftar Laporan Akhir Peserta MBKM
                        <p class="card-description">
                            Laporan Akhir
                        </p>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('fail'))
                            <div class="alert alert-danger">
                                {{ session('fail') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama (nim)</th>
                                        <th>
                                            <center>Status Persetujuan Laporan <br> Dosen Pembimbing</center>
                                        </th>
                                        <th>
                                            <center>Status Persetujuan Laporan <br> Pembimbing Lapangan</center>
                                        </th>
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
                                                @if ($item->dosbing_report == 'Y')
                                                    <center>
                                                        <div class="badge badge-success">Disetujui</div>
                                                    </center>
                                                @else
                                                    <div class="badge badge-danger">Menunggu</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->dosbingex_report == 'Y')
                                                    <center>
                                                        <div class="badge badge-success">Disetujui</div>
                                                    </center>
                                                @else
                                                    <center>
                                                        <div class="badge badge-danger">Menunggu</div>
                                                    </center>
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
                                                        <div class="badge badge-secondary">Selesai</div>
                                                    @endif
                                                </center>
                                            </td>
                                            <td style="width: 10%">
                                                @php
                                                    // $getData=\App\Models\Mbkm::where([['tahun', date('Y')], ['dosen_id', Auth::user()->dosen->id]])->whereNot('status', 'PASS')->first();
                                                    $dateMin=$item->durasi-1;
                                                    $duration = '+ ' . $dateMin . ' month';
                                                    // return $duration;
                                                    // echo $duration;
                                                    $getDateLast = date('Y-m-d', strtotime($duration, strtotime($item->date_pers)));
                                                    // echo $getDateLast;
                                                @endphp

                                                @if (Auth::user()->role == 'DOSEN')
                                                    @if ($item->report != null)
                                                        <button data-id="{{ $item->report }}" id="btn_report_pem"
                                                            data-toggle="modal" data-target="#exampleModalReportPembimbing"
                                                            class="btn btn-inverse-info" style="padding: 10px">Laporan</button>
                                                        {{-- @if (date('Y-m-d') >= $getDateLast) --}}
                                                            @if ($item->dosbing_report == null && $item->report!=null)
                                                                <button data-id="{{ $item->id }}" id="acc_report_pem"
                                                                    class="btn btn-inverse-success"
                                                                    style="padding: 10px">Acc</button>
                                                            @endif
                                                        {{-- @endif --}}
                                                    @endif
                                                @elseif(Auth::user()->role == 'PEMLAP')
                                                    @if ($item->report != null)
                                                        <button data-id="{{ $item->report }}" id="btn_report_pem"
                                                            data-toggle="modal" data-target="#exampleModalReportPembimbing"
                                                            class="btn btn-inverse-info" style="padding: 10px">Laporan</button>
                                                        {{-- @if (date('Y-m-d') >= $getDateLast) --}}
                                                            @if ($item->dosbingex_report == null)
                                                                <button type="button" class="btn btn-inverse-success"
                                                                    data-id="{{ $item->id }}" id="acc_report_pemlap"
                                                                    style="padding: 10px">Acc</button>
                                                            @endif
                                                        {{-- @endif --}}
                                                    @endif
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
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $("tr td #btn_report_pem").click(function(e) {
            var id = $(this).attr("data-id")
            // console.log(id);
            $("#show-pdf").attr("data", "/img/report/" + id);
        })
        $("#acc_report_pem").click(function(e) {
            var id = $(this).attr("data-id")
            swal({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menyetujui Laporan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/dosbing/laporan/" + id + "/acc").then((res) => res.json()).then(result => {
                            if (result.success === 1) {
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


            // console.log(id);
        })
        $("#acc_report_pemlap").click(function(e) {
            var id = $(this).attr("data-id")
            swal({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menyetujui Laporan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/pemlap/laporan/" + id + "/acc").then((res) => res.json()).then(result => {
                            if (result.success === 1) {
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


            // console.log(id);
        })
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
    </script>
@endsection
