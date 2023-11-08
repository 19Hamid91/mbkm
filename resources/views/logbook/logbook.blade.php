@extends('layouts.app')
@section('tl')
    Logbook
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Logbook anda
                        <p class="card-description">
                            Logbook
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
                        {{-- <a type="button" class="btn btn-primary btn-icon-text mb-3 float-right"
                        href="/mbkm/register?t={{ Request::is('mbkm/out') ? 'out' : 'in' }}">
                        <i class="ti-upload btn-icon-prepend"></i>
                        <b>Daftar MBKM</b>
                    </a> --}}
                        <div class="table-responsive">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Pembimbing Lapangan</th>
                                        <!--<th>Status</th>-->
                                        <!--<th>Logbook Dosbing</th>-->
                                        <!--<th>Logbook PemEx</th>-->
                                        <th>Aksi</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mbkm as $item)
                                        <tr>
                                            <td>{{ $item->mahasiswa->nama }}</td>
                                            <td>{{ $item->dosen ? $item->dosen->nama : "-" }}</td>
                                            <td>{{ $item->dosbingex ? $item->dosbingex->nama : "-" }}</td>
                                            <!--<td>-->
                                            <!--    @if ($item->status == 'WAITING')-->
                                            <!--        <div class="badge badge-warning"><b>Menunggu</b></div>-->
                                            <!--    @elseif($item->status == 'AKTIF')-->
                                            <!--        <div class="badge badge-success"><b>Aktif</b></div>-->
                                            <!--    @elseif($item->status == 'PASS')-->
                                            <!--        <div class="badge badge-warning"><b>Pass</b></div>-->
                                            <!--    @endif-->
                                            <!--</td>-->
                                            <!--<td>-->
                                            <!--    @if ($item->dosbing_logbook == null)-->
                                            <!--        <div class="badge badge-danger"><b>Menunggu</b></div>-->
                                            <!--    @else-->
                                            <!--        <div class="badge badge-success"><b>Disetujui</b></div>-->
                                            <!--    @endif-->
                                            <!--</td>-->
                                            <!--<td>-->
                                            <!--    @if ($item->dosbingex_logbook == null)-->
                                            <!--        <div class="badge badge-danger"><b>Menunggu</b></div>-->
                                            <!--    @else-->
                                            <!--        <div class="badge badge-success"><b>Disetujui</b></div>-->
                                            <!--    @endif-->
                                            <!--</td>-->
                                            <td style="width: 10%">
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
                                                        $getLogbook = \App\Models\Logbook::whereDate('tanggal', date('Y-m-d'))
                                                            ->whereHas('mbkm', function ($query) use ($item) {
                                                                $query->where([['id', $item->id], ['status', 'AKTIF']]);
                                                            })
                                                            ->first();
                                                    @endphp

                                                    @if ($getLogbook == null)
                                                        <button type="button" class="btn btn-inverse-primary btn-md" id="logbook"
                                                            data-id="{{ $item->id }}" data-tglawal="{{ $item->tanggal_awal }}" data-tglakhir="{{ $item->tanggal_akhir }}" data-toggle="modal"
                                                            data-target="#exampleModalLogbook"
                                                            style="padding: 10px"><b>Input Logbook</b></button>
                                                            
                                                    @endif

                                                    @if (!$item->logbook->isEmpty())
                                                    <button type="button" class="btn btn-inverse-warning" data-id="{{ $item->id }}"
                                                    data-toggle="modal" data-target="#exampleModalLogbookPembimbing"
                                                    data-nama="{{ $item->mahasiswa->nama . ' (' . $item->mahasiswa->nim . ')' }}"
                                                    id="btn_logbook_dosen" style="padding: 10px"><b>Logbook</b></button>
                                                       
                                                    @endif
                                                    @php
                                                        $dateMin=$item->durasi-1;
                                                        $getMonth = '+ ' . $item->durasi . ' month';
                                                        $dateReport = date('Y-m-d', strtotime($getMonth, strtotime($item->date_pers)));
                                                        // echo $dateReport;
                                                    @endphp
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Laporan anda
                        <p class="card-description">
                            Laporan
                        </p>
                        {{-- <a type="button" class="btn btn-primary btn-icon-text mb-3 float-right"
                        href="/mbkm/register?t={{ Request::is('mbkm/out') ? 'out' : 'in' }}">
                        <i class="ti-upload btn-icon-prepend"></i>
                        <b>Daftar MBKM</b>
                    </a> --}}
                        <div class="table-responsive">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Pembimbing Lapangan</th>
                                        <!--<th>Status</th>-->
                                        <th>Report Dosbing</th>
                                        <th>Report PemEx</th>
                                        <th>Aksi</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mbkm as $item)
                                        <tr>
                                            <td>{{ $item->mahasiswa->nama }}</td>
                                            <td>{{ $item->dosen ? $item->dosen->nama : "-" }}</td>
                                            <td>{{ $item->dosbingex ? $item->dosbingex->nama : "-" }}</td>
                                            <!--<td>-->
                                            <!--    @if ($item->status == 'WAITING')-->
                                            <!--        <div class="badge badge-warning"><b>Menunggu</b></div>-->
                                            <!--    @elseif($item->status == 'AKTIF')-->
                                            <!--        <div class="badge badge-success"><b>Aktif</b></div>-->
                                            <!--    @elseif($item->status == 'PASS')-->
                                            <!--        <div class="badge badge-warning"><b>Pass</b></div>-->
                                            <!--    @endif-->
                                            <!--</td>-->
                                            <td>
                                                @if ($item->dosbing_report == null)
                                                    <div class="badge badge-danger"><b>Menunggu</b></div>
                                                @else
                                                    <div class="badge badge-success"><b>Disetujui</b></div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->dosbingex_report == null)
                                                    <div class="badge badge-danger"><b>Menunggu</b></div>
                                                @else
                                                    <div class="badge badge-success"><b>Disetujui</b></div>
                                                @endif
                                            </td>
                                            <td style="width: 10%">
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
                                                        $dateMin=$item->durasi-1;
                                                        $getMonth = '+ ' . $item->durasi . ' month';
                                                        $dateReport = date('Y-m-d', strtotime($getMonth, strtotime($item->date_pers)));
                                                        // echo $dateReport;
                                                    @endphp
                                                    @if ($item->report!=null)
                                                         <button data-id="{{ $item->report }}" id="btn_report_pem"
                                                            data-toggle="modal" data-target="#exampleModalReportPembimbing"
                                                            class="btn btn-inverse-info" style="padding: 10px"><b>Dokumen</b></button>
                                                    @endif  
                                                    @if ($item->dosbing_report==null || $item->dosbingex_report==null)
                                                        
                                                    {{-- @if (date('Y-m-d') >= $dateReport) --}}
                                                        @if ($item->report == null)
                                                            <button type="button" class="btn btn-inverse-danger btn-md"
                                                                id="report" data-id="{{ $item->id }}"
                                                                data-toggle="modal" data-type="upload"
                                                                data-target="#exampleModalLaporan"
                                                                style="padding: 10px"><b>Upload Dokumen</b></button>
                                                        @else
                                                            <button type="button" class="btn btn-inverse-danger btn-md"
                                                                id="report" data-id="{{ $item->id }}"
                                                                data-toggle="modal" data-type="edit"
                                                                data-target="#exampleModalLaporan"
                                                                style="padding: 10px"><b>Edit Dokumen</b></button>
                                                        @endif
                                                    {{-- @endif --}}
                                                    @endif
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
    </div>
@endsection
@section('js')
    <script>
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
                    var onlyDate = element.tanggal.split(" ")
                    var note = element.note == null ? "" : element.note
                    var notex = element.notex == null ? "" : element.notex
                    var btnNote = "<textarea class='note' cols='20' rows='2' disabled>" + note + "</textarea></td><td>";
                    var btnNotex = "<textarea class='note' cols='20' rows='2' disabled>" + notex + "</textarea></td><td>";
                    if (status === 1 && statusex === 1) {
                        statusIcon = "<span class='badge badge-success'>Setujui</span>";
                        btnEdit = "</td><td><textarea disabled class='edit-body' cols='20' rows='2'>" + element.body + "</textarea></td><td>";
                        btnTanggal = date_fix;
                    } 
                    // else if (status === 2 && statusex === 2) {
                    //     statusIcon = "<span class='badge badge-danger'>Tolak</span>";
                    //     btnEdit = "</td><td><textarea disabled class='edit-body' cols='35' rows='2'>" + element.body + "</textarea></td><td>";
                    //     btnTanggal = date_fix;
                    // }
                    var btnDelete = "";
                    if (!(status === 1 && statusex === 1)) {
                        btnDelete = "<button type='button' id='editbtn-" + element.id + "' data-id='" + element.id + "' class='btn btn-warning'>Edit</button>";
                        btnEdit = "'></td><td><textarea class='edit-body' cols='20' rows='2'>" + element.body + "</textarea></td><td>";
                        btnTanggal = "<input type='date' id='tglLogbook' class='edit-date' value='" + (onlyDate[0] || "")
                    }

                    $(".tbl_logbook").append(
                        "<tr style='border-bottom: 1pt solid black;' class='trtr_logbook'><td style='width:30%'>" + btnTanggal + btnEdit + btnNote + btnNotex + btnDelete +
                        "<span class='status-icon' data-logbook-id='" + element.id + "'>" + statusIcon + "</span>" +
                        "</td></tr>"
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
        $(".tbl_logbook").on("click", "#deletebtn", function(e) {
            var logbookId = $(this).data('id');
            // console.log(logbookId)
            e.preventDefault()
            Swal.fire({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menghapus Logbook?",
                    icon: "warning",
                    // buttons: true,
                    // dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/mbkm/logbooks/"+logbookId)
                        .then((res)=>res.json())
                        .then(result=>{
                                    if(result.success===1){
                                        console.log(result.success);
                                            Swal.fire(result.message, {
                                                    icon: "success",
                                                });
                                                setTimeout(() => {
                                                    location.reload()
                                    }, 2000);
                                }
                            })
                    }})
                });
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

        $('tr td #report').on('click', function() {
            var myBookId = $(this).data('id');
            var type = $(this).data('type');
            console.log(type)
            if(type==="upload"){
                $("#form-action").attr("action","/mbkm/report")
                $("#txt-header").html("Upload Dokumen")
            }else{
                $("#form-action").attr("action","/mbkm/report")
                $("#txt-header").html("Edit Dokumen")
            }
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
