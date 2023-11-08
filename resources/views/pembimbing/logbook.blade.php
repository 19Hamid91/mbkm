@extends('layouts.app')
@section('tl')
    Logbook
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
                    <h4 class="card-title">Daftar Logbook Peserta MBKM
                        <p class="card-description">
                            Logbook Peserta
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
                                        <th>Status Persetujuan Logbook</th>
                                        <th>Logbook Pembimbing Lapangan</th>
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
                                                @if ($item->dosbing_logbook == 'Y')
                                                    <div class="badge badge-success">Disetujui</div>
                                                @else
                                                    <div class="badge badge-danger">Menunggu</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->dosbingex_logbook == 'Y')
                                                    <div class="badge badge-success">Disetujui</div>
                                                @else
                                                    <div class="badge badge-danger">Menunggu</div>
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
                                                    $dateMin=$item->durasi-1;
                                                    $getMonth = '+ ' . $dateMin . ' month';
                                                    $dateReport = date('Y-m-d', strtotime($getMonth, strtotime($item->date_pers)));
                                                    // echo $dateReport;
                                                @endphp
                                                @if (Auth::user()->role == 'DOSEN')
                                                    {{-- @if (date('Y-m-d') >= $dateReport) --}}
                                                        @if ($item->dosbing_logbook == null)
                                                        <button type="button" class="btn btn-inverse-info" data-id="{{ $item->id }}"
                                                            data-toggle="modal" data-target="#exampleModalLogbookPembimbing"
                                                            data-nama="{{ $item->mahasiswa->nama . ' (' . $item->mahasiswa->nim . ')' }}"
                                                            id="btn_logbook_dosen" style="padding: 10px">Logbook</button>
                                                        @endif
                                                    {{-- @endif --}}
                                                @elseif(Auth::user()->role == 'PEMLAP')
                                                    {{-- @if (date('Y-m-d') >= $dateReport) --}}
                                                        @if ($item->dosbingex_logbook == null)
                                                        <button type="button" class="btn btn-inverse-info" data-id="{{ $item->id }}"
                                                            data-toggle="modal" data-target="#exampleModalLogbookPembimbing"
                                                            data-nama="{{ $item->mahasiswa->nama . ' (' . $item->mahasiswa->nim . ')' }}"
                                                            id="btn_logbook_dosenex" style="padding: 10px">Logbook</button>
                                                        @endif
                                                    {{-- @endif --}}
                                                @endif
                                                {{-- @if (Auth::user()->role == 'DOSEN') --}}
                                                    {{-- @if (date('Y-m-d') >= $dateReport) --}}
                                                        {{-- @if ($item->dosbing_logbook == null)
                                                            <button type="button" class="btn btn-inverse-success"
                                                                data-id="{{ $item->id }}" id="acc_logbook_dosbing"
                                                                style="padding: 10px">Acc</button>
                                                        @endif --}}
                                                    {{-- @endif --}}
                                                {{-- @elseif(Auth::user()->role == 'PEMLAP') --}}
                                                    {{-- @if (date('Y-m-d') >= $dateReport) --}}
                                                        {{-- @if ($item->dosbingex_logbook == null)
                                                            <button type="button" class="btn btn-inverse-success"
                                                                data-id="{{ $item->id }}" id="acc_logbook_pemlap"
                                                                style="padding: 10px">Acc</button>
                                                        @endif --}}
                                                    {{-- @endif --}}
                                                {{-- @endif --}}
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
        $("tr td #btn_logbook_dosen").click(function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var nama = $(this).attr("data-nama");
        $("#mbkm_id").val(id);
        $("#nama_peserta").html(nama);
        // console.log(id);
        $(".trtr_logbook").remove();
        fetch("/api/dosbing/logbook/" + id)
            .then((res) => res.json())
            .then((result) => {
                result.data.forEach((element) => {
                    const date = new Date(element.tanggal);
                    const date_fix = new Intl.DateTimeFormat(["ban", "id"], {
                        dateStyle: "full",
                        timeZone: "Asia/Jakarta",
                    }).format(date);
                    var status = element.status;
                    var edit = "disabled"
                    if(status != 1 && status != 2){
                        edit = ""
                    }
                    var note = element.note == null ? "" : element.note
                    var notex = element.notex == null ? "" : element.notex
                    $(".tbl_logbook").append(
                        "<tr style='border-bottom: 1pt solid black;' class='trtr_logbook'><td style='width:30%'>" +
                        date_fix + "</td><td>" + element.body + "</td>" + "<td><textarea class='note' cols='20' rows='2'" + edit + ">" + note + "</textarea></td>" + 
                        "<td><textarea class='notex' cols='20' rows='2' disabled>" + notex + "</textarea></td>" +
                        "<td>" +
                        "<button class='approve-button btn btn-success mr-1' data-logbook-id='" + element.id + "' value='1'>" +
                        "Setujui" +
                        "</button>" +
                        "<button class='reject-button btn btn-danger' data-logbook-id='" + element.id + "' value='2'>" +
                        "Tolak" +
                        "</button>" +
                        "<span class='status-icon' data-logbook-id='" + element.id + "'></span>" +
                        "</td></tr>"
                    );

                    if (status === 1) {
                        $(".approve-button[data-logbook-id='" + element.id + "']").hide();
                        $(".reject-button[data-logbook-id='" + element.id + "']").hide();
                        var statusIcon = $(".status-icon[data-logbook-id='" + element.id + "']");
                        statusIcon.empty();
                        var badge = $("<span class='badge badge-success'>Setujui</span>");
                        statusIcon.append(badge);
                    } else if (status === 2) {
                        $(".approve-button[data-logbook-id='" + element.id + "']").hide();
                        $(".reject-button[data-logbook-id='" + element.id + "']").hide();
                        var statusIcon = $(".status-icon[data-logbook-id='" + element.id + "']");
                        statusIcon.empty();
                        var badge = $("<span class='badge badge-danger'>Tolak</span>");
                        statusIcon.append(badge);
                    }


                });
                
                $(".approve-button").on("click", function() {
                    var status = 1;
                    var logbookId = $(this).data('logbook-id');
                    var note = "";
                    sendStatus(logbookId, status, note);
                    $(this).closest('tr').find('.note').prop("disabled", true);

                    $(this).hide();
                    $(".reject-button[data-logbook-id='" + logbookId + "']").hide();

                    var statusIcon = $(".status-icon[data-logbook-id='" + logbookId + "']");
                    statusIcon.empty();

                    var badge = $("<span class='badge badge-success'>Setujui</span>");
                    statusIcon.append(badge);
                });

                $(".reject-button").on("click", function() {
                    var status = 2;
                    var logbookId = $(this).data('logbook-id');
                    var note = $(this).closest('tr').find('.note').val();
                    sendStatus(logbookId, status, note);
                    $(this).closest('tr').find('.note').prop("disabled", true);

                    $(this).hide();
                    $(".approve-button[data-logbook-id='" + logbookId + "']").hide();

                    var statusIcon = $(".status-icon[data-logbook-id='" + logbookId + "']");
                    statusIcon.empty();

                    var badge = $("<span class='badge badge-danger'>Tolak</span>");
                    statusIcon.append(badge);
                });

            });
    });

    function sendStatus(logbookId, status, note) {
        // Kirim status ke server melalui permintaan AJAX
        $.ajax({
            type: "POST",
            url: "/api/dosbing/status/" + logbookId, 
            data: {
                status: status,
                note: note
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }

    $("tr td #btn_logbook_dosenex").click(function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var nama = $(this).attr("data-nama");
        $("#mbkm_id").val(id);
        $("#nama_peserta").html(nama);
        // console.log(id);
        $(".trtr_logbook").remove();
        fetch("/api/dosbing/logbook/" + id)
            .then((res) => res.json())
            .then((result) => {
                result.data.forEach((element) => {
                    const date = new Date(element.tanggal);
                    const date_fix = new Intl.DateTimeFormat(["ban", "id"], {
                        dateStyle: "full",
                        timeZone: "Asia/Jakarta",
                    }).format(date);
                    var statusex = element.statusex;
                    var edit = "disabled"
                    if(statusex != 1 && statusex != 2){
                        edit = ""
                    }
                    var note = element.note == null ? "" : element.note
                    var notex = element.notex == null ? "" : element.notex
                    $(".tbl_logbook").append(
                        "<tr style='border-bottom: 1pt solid black;' class='trtr_logbook'><td style='width:30%'>" +
                        date_fix + "</td><td>" + element.body + "</td>" + "<td><textarea class='note' cols='20' rows='2' disabled>" + note + "</textarea></td>" + 
                        "<td><textarea class='notex' cols='20' rows='2'" + edit + ">" + notex + "</textarea></td>" +
                        "<td>" +
                        "<button class='approve-button btn btn-success mr-1' data-logbook-id='" + element.id + "' value='1'>" +
                        "Setujui" +
                        "</button>" +
                        "<button class='reject-button btn btn-danger' data-logbook-id='" + element.id + "' value='2'>" +
                        "Tolak" +
                        "</button>" +
                        "<span class='status-icon' data-logbook-id='" + element.id + "'></span>" +
                        "</td></tr>"
                    );

                    if (statusex === 1) {
                        $(".approve-button[data-logbook-id='" + element.id + "']").hide();
                        $(".reject-button[data-logbook-id='" + element.id + "']").hide();
                        var statusIcon = $(".status-icon[data-logbook-id='" + element.id + "']");
                        statusIcon.empty();
                        var badge = $("<span class='badge badge-success'>Setujui</span>");
                        statusIcon.append(badge);
                    } else if (statusex === 2) {
                        $(".approve-button[data-logbook-id='" + element.id + "']").hide();
                        $(".reject-button[data-logbook-id='" + element.id + "']").hide();
                        var statusIcon = $(".status-icon[data-logbook-id='" + element.id + "']");
                        statusIcon.empty();
                        var badge = $("<span class='badge badge-danger'>Tolak</span>");
                        statusIcon.append(badge);
                    }


                });
                
                $(".approve-button").on("click", function() {
                    var statusex = 1;
                    var logbookId = $(this).data('logbook-id');
                    var notex = "";
                    sendStatusex(logbookId, statusex, notex);
                    $(this).closest('tr').find('.notex').prop("disabled", true);

                    $(this).hide();
                    $(".reject-button[data-logbook-id='" + logbookId + "']").hide();

                    var statusIcon = $(".status-icon[data-logbook-id='" + logbookId + "']");
                    statusIcon.empty();

                    var badge = $("<span class='badge badge-success'>Setujui</span>");
                    statusIcon.append(badge);
                });

                $(".reject-button").on("click", function() {
                    var statusex = 2;
                    var logbookId = $(this).data('logbook-id');
                    var notex = $(this).closest('tr').find('.notex').val();
                    sendStatusex(logbookId, statusex, notex);
                    $(this).closest('tr').find('.notex').prop("disabled", true);

                    $(this).hide();
                    $(".approve-button[data-logbook-id='" + logbookId + "']").hide();

                    var statusIcon = $(".status-icon[data-logbook-id='" + logbookId + "']");
                    statusIcon.empty();

                    var badge = $("<span class='badge badge-danger'>Tolak</span>");
                    statusIcon.append(badge);
                });

            });
    });

    function sendStatusex(logbookId, statusex, notex) {
        // Kirim status ke server melalui permintaan AJAX
        $.ajax({
            type: "POST",
            url: "/api/dosbing/statusex/" + logbookId, 
            data: {
                statusex: statusex,
                notex: notex
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }


        $("tr td #btn_report_pem").click(function(e) {
            var id = $(this).attr("data-id")
            // console.log(id);
            $("#show-pdf").attr("data", "/img/report/" + id);
        })
        $("tr td #acc_logbook_dosbing").click(function(e) {
            var id = $(this).attr("data-id")
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
                                setTimeout(() => {
                                    location.reload()
                                }, 3000);
                            }
                        })


                    }
                });


            // console.log(id);
        })
        $("#acc_logbook_pemlap").click(function(e) {
            var id = $(this).attr("data-id")
            swal({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menyetujui Logbook?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/pemlap/logbook/" + id + "/acc").then((res) => res.json()).then(result => {
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
                $("#dosen_tbl").html(result.data.dosen.nama)
                $("#pemEx_tbl").html(result.data.pem_ex.nama)
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
