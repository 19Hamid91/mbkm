@extends('layouts.app')
@section('tl')
    Logbook
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">History MBKM
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
                                        <th>Nama</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Pembimbing Lapangan</th>
                                        <th>Status</th>
                                        <th>File</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mbkm as $item)
                                        <tr>
                                            <td><a href="#" data-id="{{ $item->id }}" id="detail_peng"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalDetail">{{ $item->mahasiswa->nama . '(' . $item->mahasiswa->nim . ')' }}</a></td>
                                            <td>{{ $item->dosen ? $item->dosen->nama : "-" }}</td>
                                            <td>{{ $item->dosbingex ? $item->dosbingex->nama : "-" }}</td>
                                            <td><div class="badge badge-secondary"><b>Selesai</b></div></td>
                                            <td style="width: 10%">
                                            <button type="button" class="btn btn-inverse-warning" data-id="{{ $item->id }}" 
                                                data-toggle="modal" data-target="#exampleModalLogbookPembimbing" 
                                                data-nama="{{ $item->mahasiswa->nama . ' (' . $item->mahasiswa->nim . ')' }}"
                                                    id="btn_logbook_dosen" style="padding: 10px"><b>Logbook</b></button>
                                            <button data-id="{{ $item->report }}" id="btn_report_pem" data-toggle="modal" 
                                                data-target="#exampleModalReportPembimbing" class="btn btn-inverse-info" style="padding: 10px"><b>Dokumen</b></button>
                                            <button data-id="{{ $item->id }}" id="show-form" data-toggle="modal" 
                                                data-target="#exampleModal" class="btn btn-inverse-success" style="padding: 10px"><b>Berkas</b></button>
                                            </td>
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
    <script>
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
                // console.log( result.data.support)
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
        $("tr td #btn_report_pem").click(function(e) {
            var id = $(this).attr("data-id")
            // console.log(id);
            $("#show-pdf").attr("data", "/img/report/" + id);
        })
        $("tr td #btn_logbook_dosen").click(function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id")
            var nama = $(this).attr("data-nama")
            $("#mbkm_id").val(id)
            $("#nama_peserta").html(nama)
            // console.log(id);
            $(".trtr_logbook").remove()
            fetch("/api/dosbing/logbook/" + id).then((res) => res.json()).then(result => {
                result.data.forEach(element => {
                    const date = new Date(element.tanggal ? element.tanggal : element.created_at);
                    const date_fix = new Intl.DateTimeFormat(["ban", "id"], {
                        dateStyle: "full",
                        timeZone: "Asia/Jakarta",
                    }).format(date);
                    var status = element.status;
                    var statusex = element.statusex;
                    var statusIcon = "";
                    var btnEdit = ""; // Inisialisasi variabel btnEdit
                    var note = element.note == null ? "" : element.note
                    var notex = element.notex == null ? "" : element.notex
                    var btnNote = "<textarea class='note' cols='20' rows='2' disabled>" + note + "</textarea></td><td>";
                    var btnNotex = "<textarea class='note' cols='20' rows='2' disabled>" + notex + "</textarea></td><td>";
                    // if (status === 1 && statusex === 1) {
                        statusIcon = "<span class='badge badge-success'>Setujui</span>";
                        btnEdit = "</td><td><textarea disabled class='edit-body' cols='20' rows='2'>" + element.body + "</textarea></td><td>";
                        btnTanggal = date_fix;
                    // } 
                    // else if (status === 2 && statusex === 2) {
                    //     statusIcon = "<span class='badge badge-danger'>Tolak</span>";
                    //     btnEdit = "</td><td><textarea disabled class='edit-body' cols='35' rows='2'>" + element.body + "</textarea></td><td>";
                    //     btnTanggal = date_fix;
                    // }

                    var btnDelete = "";
                    // if (!(status === 1 && statusex === 1)) {
                    //     btnDelete = "<button type='button' id='editbtn-" + element.id + "' data-id='" + element.id + "' class='btn btn-warning'>Edit</button>";
                    //     btnEdit = "'></td><td><textarea class='edit-body' cols='35' rows='2'>" + element.body + "</textarea></td><td>";
                    //     btnTanggal = "<input type='date' id='tglLogbook' class='edit-date' value='" + (element.tanggal || "")
                    // }
                    $('.tbl_logbook #logbook_status').hide();
                    $(".tbl_logbook").append(
                        "<tr style='border-bottom: 1pt solid black;' class='trtr_logbook'><td style='width:30%'>" + btnTanggal + btnEdit + btnNote + btnNotex + "</td></tr>"
                    );
                });
            });

        $(document).off('click', 'button.btn-warning'); // Matikan event handler yang sebelumnya jika ada
        $(document).on('click', 'button.btn-warning', function() {
            var logbookId = $(this).data('id');
            var tanggal = $(this).closest('tr').find('input.edit-date').val();
            var body = $(this).closest('tr').find('textarea.edit-body').val();

            editBody(logbookId, body, tanggal);
        });
    });

    function editBody(logbookId, body, tanggal) {
        // Kirim status ke server melalui permintaan AJAX
        $.ajax({
            type: "POST",
            url: "/api/dosbing/editbody/" + logbookId,
            data: {
                body: body,
                tanggal: tanggal
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    icon: "success",
                    width: '400px'
                });
                // console.log(response);
            },
            error: function(error) {
                Swal.fire({
                    title: "Gagal",
                    icon: "error",
                    width: '400px'
                });
                // console.error("Error:", error);
            }
        });
    }
         $('tr td #logbook').on('click', function() {
            var tglAwal = $(this).data('tglawal')
            var tglAkhir = $(this).data('tglakhir')
            var myBookId = $(this).data('id');
            
            $(".modal-body #id").val(myBookId);
            var unAvailableDates = [];
            $( function() {
                fetch("/api/getLogbook/"+myBookId).then((res) => res.json()).then(result => {
                    for (let i = 0; i < result['data'].length; i++) {
                        let date = result['data'][i].tanggal.split(" ")
                        unAvailableDates.push(date[0])
                    }
                
                $( "#datelogbook" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    showButtonPanel: true,
                    beforeShowDay: function(d) {        
                        var year = d.getFullYear(),
                            month = ("0" + (d.getMonth() + 1)).slice(-2),
                            day = ("0" + (d.getDate())).slice(-2);
                
                        var formatted = year + '-' + month + '-' + day;
                
                        if ($.inArray(formatted, unAvailableDates) != -1) {
                            return [false,"","unAvailable"]; 
                        } else{
                            return [true, "","Available"]; 
                        }
                    }
                });
                $("#datelogbook").datepicker("option", "minDate", new Date(tglAwal));
                $("#datelogbook").datepicker("option", "maxDate", new Date(tglAkhir));
            })
        } );
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
