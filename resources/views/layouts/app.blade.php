<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('tl')</title>
    <!-- plugins:css -->
    @include('partials.header')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('partials.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            {{-- <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div> --}}
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
                            aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-inverse-primary todo-list-add-btn"
                                        id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                            <p class="text-gray mb-0">The total number of sessions</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small
                                class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="{{ asset('assets/images/faces/face1.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('assets/images/faces/face2.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('assets/images/faces/face3.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('assets/images/faces/face4.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('assets/images/faces/face5.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('assets/images/faces/face6.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('partials.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.</span>
                    </div>
                    <!--<div class="d-sm-flex justify-content-center justify-content-sm-between">-->
                    <!--    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a-->
                    <!--            href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>-->
                    <!--</div>-->
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Progress Pengumpulan Formulir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable" style="width: 100%">
                            <tr id="tr_portofolio">
                                <td><b>Portofolio</b><br></td>
                                <td>
                                <td style="width: 20%">
                                    <label id="label_portofolio" class="float-right">Pending</label>
                                </td>
                                </td>
                                <td>
                                    <a href="" target="_blank" id="link_portofolio"
                                        class="btn btn-inverse-primary float-right">Lihat
                                        Dokument</a>
                                </td>

                            </tr>
                            <tr>
                                <td><b>Transkrip Nilai</b><br></td>
                                <td>
                                <td style="width: 20%">
                                    <label id="label_nilai" class="float-right">Pending</label>
                                </td>
                                </td>
                                <td>
                                    <a href="" target="_blank" id="link_nilai"
                                        class="btn btn-inverse-primary float-right">Lihat
                                        Dokument</a>
                                </td>

                            </tr>
                            <tr>
                                <td><b>Surat Pakta Integritas</b></td>
                                <td>
                                <td>
                                    <label id="label_pakta">Pending</label>
                                </td>
                                </td>
                                <td>
                                    <a href="" target="_blank" id="link_pakta"
                                        class="btn btn-inverse-primary">Lihat
                                        Dokument</a>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Surat Rekomendasi Perguruan Tinggi Asal</b></td>
                                <td>
                                <td>
                                    <label id="label_rekom">Success</label>
                                </td>
                                </td>
                                <td>
                                    <a href="" target="_blank" id="link_rekom"
                                        class="btn btn-inverse-primary">Lihat
                                        Dokument</a>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Surat Persetujuan Orang Tua </b></td>
                                <td>
                                <td>
                                    <label id="label_ortu">Pending</label>
                                </td>
                                </td>
                                <td>
                                    <a href="" target="_blank" id="link_ortu"
                                        class="btn btn-inverse-primary">Lihat
                                        Dokument</a>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Surat Keterangan Sehat</b><br><small>Tidak Wajib</small></td>
                                <td>
                                <td>
                                    <label id="label_sehat">Success</label>
                                </td>
                                </td>
                                <td>
                                    <a href="" target="_blank" id="link_sehat"
                                        class="btn btn-inverse-primary">Lihat
                                        Dokument</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalPers" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Progress Persetujuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <tr>
                                <td><b>Persetujuan Kaprodi</b><br></td>
                                <td>
                                <td>
                                    <label id="label_kaprodi">Pending</label>
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Persetujuan Kajur</b></td>
                                <td>
                                <td>
                                    <label id="label_kajur">Pending</label>
                                </td>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td><b>Persetujuan Direktur</b></td>
                                <td>
                                <td>
                                    <label id="label_direktur">Success</label>
                                </td>
                                </td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLogbook" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Progress Logbook</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="/mbkm/logbook" method="POST">
                        <input type="hidden" name="id" id="id">
                        @csrf
                        <div id="datepicker"></div>
                        <div class="form-group">
                            <label for="exampleInputDate"><b>Tanggal</b></label>
                            <input class="form-control" name="tanggal" id="datelogbook" cols="30" rows="10"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><b>Progres yang anda lakukan hari ini</b></label>
                            <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-inverse-primary mr-2">
                            Submit
                        </button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLaporan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="txt-header"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="" id="form-action" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id_report">
                        <input type="hidden" name="type" id="type">
                        <p>Upload dokumen Laporan, Transkirp Nilai, Sertifikat dalam 1 file</p>
                        @csrf
                        <div class="form-group">
                            {{-- <label for="exampleInputEmail1"><b>Progres yang anda lakukan hari ini</b></label> --}}
                            <input id="laporan" type="file" required name="report" class="form-control" accept="application/pdf">
                            <label for="" class="text-danger">File yang diizinkan .pdf dan max 5MB</label>
                            {{-- <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea> --}}
                        </div>
                        <button type="submit" class="btn btn-inverse-primary mr-2">
                            Submit
                        </button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalForm" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Form Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" action="/mbkm/form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id_form">
                        @csrf
                        <div class="form-group">
                            {{-- <label for="exampleInputEmail1"><b>Progres yang anda lakukan hari ini</b></label> --}}
                            <input type="file" required name="forma" class="form-control">
                            <label for="" class="text-danger">File yang diizinkan .pdf</label>
                            {{-- <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea> --}}
                        </div>
                        <button type="submit" class="btn btn-inverse-primary mr-2">
                            Submit
                        </button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalNilai" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelNilai"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" id="form_nilai" action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id_mbkm_nilai">
                        <center>
                            <h4 name="type" id="type_nilai" readonly></h4>
                        </center>
                        <!--<small>Rentang nilai: 0 - 100</small>-->

                        @csrf
                        <!--<div class="form-group">-->
                        <!--    <label for=""><b>Nilai Kognitif</b></label>-->
                        <!--    <input type="number" required name="kognitif" placeholder="Nilai Kognitif"-->
                        <!--        class="form-control">-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                        <!--    <label for=""><b>Nilai Kreatif</b></label>-->
                        <!--    <input type="number" required name="kreatif" placeholder="Nilai Kreatif"-->
                        <!--        class="form-control">-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                        <!--    <label for=""><b>Nilai Komunikasi</b></label>-->
                        <!--    <input type="number" required name="komunikasi" placeholder="Nilai Komunikasi"-->
                        <!--        class="form-control">-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                        <!--    <label for=""><b>Nilai Keaktifan</b></label>-->
                        <!--    <input type="number" required name="keaktifan" placeholder="Nilai Keaktifan"-->
                        <!--        class="form-control">-->
                        <!--</div>-->
                        <div class="form-group">
                            <label for=""><b>Nilai</b></label>
                            <small>(0 - 100)</small>
                            <input type="number" required name="nilai" placeholder="Nilai"
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            Submit
                        </button>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <center><img src="/img/loading.gif" id="loading-detail" style="max-width: 40%" alt="">
                </center>
                <div class="modal-body">
                    <div class="table-responsive" id="tbl-detail" style="display: none">
                        <table class="">
                            <tr>
                                <td style="width: 50%">Nama Mahasiswa</td>
                                <td><b>:</b></td>
                                <td id="nama_tbl"></td>
                            </tr>
                            <tr>
                                <td>Tahun Pengajuan</td>
                                <td><b>:</b></td>
                                <td id="tahun_tbl"></td>
                            </tr>
                            <tr>
                                <td>Prodi Asal</td>
                                <td><b>:</b></td>
                                <td id="prodi_tbl"></td>
                            </tr>
                            <tr>
                                <td>Jenis Program</td>
                                <td><b>:</b></td>
                                <td id="jenis_tbl"></td>
                            </tr>
                            <tr>
                                <td>Alasan Memilih ini</td>
                                <td><b>:</b></td>
                                <td id="alasan_tbl"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><b>:</b></td>
                                <td>
                                    <div id="status_tbl"><b>AKTIF</b></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Lembaga</td>
                                <td><b>:</b></td>
                                <td id="lembaga_tbl">Dinas Pertanian</td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td><b>:</b></td>
                                <td id="durasi_tbl">3 Bulan</td>
                            </tr>
                            {{-- <tr>
                                <td>Tanggal Mulai</td>
                                <td><b>:</b></td>
                                <td id="tgl_mulai"></td>
                            </tr>
                            <tr>
                                <td>Tangkal Selesai</td>
                                <td><b>:</b></td>
                                <td id="tgl_selesai"></td>
                            </tr> --}}
                            <tr>
                                <td>Rincian</td>
                                <td><b>:</b></td>
                                <td id="rincian_id"></td>
                            </tr>
                            <tr>
                                <td>Dosen Pembimbing</td>
                                <td><b>:</b></td>
                                <td id="dosen_tbl"></td>
                            </tr>
                            <tr>
                                <td>Pembimbing Eksternal</td>
                                <td><b>:</b></td>
                                <td id="pemEx_tbl"></td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <div id="studen_swap_tbl" style="display: none">
                            <h3>Informasi Pertukaran Pelajar</h3>
                            <table>
                                <tr>
                                    <td style="width: 25%">Nama Prodi</td>
                                    <td><b>:</b></td>
                                    <td id="per_prodi"></td>
                                </tr>
                                <tr>
                                    <td>Matkul</td>
                                    <td><b>:</b></td>
                                    <td>
                                        <table id="tbl_student_swap">

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="knn_tbl" style="display: none">
                            <h3>Informasi KKN</h3>
                            <table>
                                <tr>
                                    <td style="width: 60%">Sumber Pendanaan</td>
                                    <td><b>:</b></td>
                                    <td id="kkn_dana_tbl"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td><b>:</b></td>
                                    <td id="kkn_jumlah"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>:</b></td>
                                    <td>
                                        <table id="kkn_mahasiswa">

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLogbookPembimbing" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logbook Peserta <b><span
                                id="nama_peserta"></span></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="tbl_logbook" style="width: 100%;border-collapse: collapse">
                            <tr style="border-bottom: 1pt solid black;">
                                <th>Tanggal Logbook</th>
                                <th>Hasil Logbook</th>
                                <th>Note Dosbing</th>
                                <th>Note Pemlap</th>
                                <!-- <th>Aksi</th> -->
                                <th id="logbook_status">Status</th>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalPemlab" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Akun Pembimbing Lapangan <b><span
                                id="nama_peserta"></span></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Untuk password default adalah <code>mbkm{{ date('Y') }}</code></span>

                    <div class="table-responsive mt-4">
                        <form action="/mbkm/add/pemlap" method="post">
                            @csrf
                            <input type="hidden" id="id_dosen_ex" name="id">
                            <div class="form-group">
                                <label for="nama">Nama Pembimbing Lapangan</label>
                                <input type="text" required name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama">Email</label>
                                <input type="email" required name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama">Jabatan</label>
                                <input type="text" required name="jabatan" class="form-control">
                            </div>
                            <button class="btn btn-inverse-primary" type="submit">Buat Akun</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalReportPembimbing" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <object data="" id="show-pdf" type="application/pdf" width="100%" height="500px">
                        <p>Unable to display PDF file. <a href="">Download</a> instead.</p>
                    </object>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalChangePass" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    {{-- <form action="" method="post"> --}}
                    <div class="form-group">
                        <label for="">Masukan password lama</label>
                        <input type="password" required name="password_old" id="pass_old" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Masukan password baru</label>
                        <input type="password" required name="password" id="pass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi password</label>
                        <input type="password" required name="ver" id="ver_pass" class="form-control">
                    </div>
                    <button class="btn btn-inverse-primary" id="btn-change-pass">Proses</button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 'ADMIN')
    <div class="modal fade" id="exampleModalChangeRole" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    <form action="/admin/changerole" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="dosen">Dosen</label>
                            <div class="table-responsive">
                                <select required id="dosen" name="dosen" style="width: 100%" class="js-example-basic-single select2-hidden-accessible">
                                    <option value="">---PILIH DOSEN---</option>
                                </select>
                            </div>
                        </div>                        
                    <div class="form-group">
                        <label for="">Role lama</label>
                        <input type="text" required name="role_lama" id="role_lama" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Role baru</label>
                        <div class="table-responsive">
                            <select required name="role_baru" style="width: 100%"
                                class="js-example-basic-single select2-hidden-accessible" id="role_baru">
                                <option value="">---PILIH ROLE---</option>
                                <option value="ADMIN">Admin</option>
                                <option value="PIMPINAN">Pimpinan</option>
                                <option value="KAJUR">Kajur</option>
                                <option value="KAPRODI">Kaprodi</option>
                                <option value="PIC">PIC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="jenis_pic" style="display:none">
                        <label for="">PIC</label>
                        <div class="table-responsive">
                            <select name="pic" style="width: 100%"
                                class="js-example-basic-single select2-hidden-accessible" id="pic">
                                <option value="">---PILIH PIC---</option>
                                @if(isset($pic))
                                    @foreach($pic as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenis_pic }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="div_jurusan" style="display:none">
                        <label for="">Jurusan</label>
                        <div class="table-responsive">
                            <select name="jurusan" style="width: 100%"
                                class="js-example-basic-single select2-hidden-accessible" id="jurusan">
                                <option value="">---PILIH JURUSAN---</option>
                                @if(isset($jurusan))
                                    @foreach($jurusan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="div_prodi" style="display:none">
                        <label for="">Prodi</label>
                        <div class="table-responsive">
                            <select name="prodi" style="width: 100%"
                                class="js-example-basic-single select2-hidden-accessible" id="prodi">
                                <option value="">---PILIH PRODI---</option>
                                @if(isset($prodi))
                                    @foreach($prodi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-inverse-primary" id="btn-change-role">Ubah </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalAddPIC" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah PIC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    <form action="/admin/addPic" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama PIC</label>
                            <input type="text" required name="nama_pic" id="nama_pic" class="form-control">
                        </div>
                        <div class="table-responsive">
                            <select name="program_id" style="width: 100%"
                                class="js-example-basic-single select2-hidden-accessible" id="program_id">
                                <option value="">---PILIH PROGRAM---</option>
                                @if(isset($programs))
                                    @foreach($programs as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-inverse-primary mt-3" id="btn-add-pic">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalAddJurusan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    <form action="/admin/addJurusan" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Jurusan</label>
                            <input type="text" required name="nama_jurusan" id="nama_jurusan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-inverse-primary" id="btn-add-jurusan">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalAddProdi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    <form action="/admin/addProdi" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Prodi</label>
                            <input type="text" required name="nama_prodi" id="nama_prodi" class="form-control">
                        </div>
                        <div class="form-group" id="jurusan">
                            <label for="">Jurusan</label>
                            <div class="table-responsive">
                                <select required name="jurusan_id" style="width: 100%"
                                    class="js-example-basic-single select2-hidden-accessible" id="jurusan_id">
                                    <option value="">---PILIH JURUSAN---</option>
                                    @if(isset($jurusan))
                                        @foreach($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-inverse-primary" id="btn-add-prodi">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalEditProdi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    <form action="/admin/editProdi" method="post">
                        @csrf
                        <input id="id_prodi" name="id_prodi" type="hidden" value="">
                        <div class="form-group">
                            <label for="">Nama Prodi</label>
                            <input type="text" required name="edit_nama_prodi" id="edit_nama_prodi" class="form-control">
                        </div>
                        <div class="form-group" id="edit_jurusan">
                            <label for="">Jurusan</label>
                            <div class="table-responsive">
                                <select required name="edit_jurusan_id" id="edit_jurusan_id" style="width: 100%"
                                    class="js-example-basic-single select2-hidden-accessible" id="edit_jurusan_id">
                                    <option value="">sdsd</option>
                                    @if(isset($jurusan))
                                        @foreach($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-inverse-primary" id="btn-add-prodi">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->role == 'PIC' || Auth::user()->pic)
    <div class="modal fade" id="exampleModalSK" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Surat Rekomendasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (isset($item)) 
                    <form class="forms-sample" action="/pic/setsk" method="POST">
                    @endif
                        @csrf
                        <input type="hidden" id="id_mbkmsk" name="id_mbkmsk" value="">
                        <div class="form-group">
                            <label for="exampleInputSK"><b>Nomor SK</b></label>
                            <input class="form-control" name="nosk" id="nosk" cols="30" rows="10"/>
                        </div>
                        <!--<div class="form-group" style="display:none" id="direktur_value">-->
                        <!--    <label for="exampleInputSK"><b>Penandatangan</b></label>-->
                        <!--    <input class="form-control" name="dirval" id="dirval" cols="30" rows="10"/ readonly>-->
                        <!--</div>-->
                        <div class="table-responsive" id="select_direktur">
                            <select required name="direktur" style="width: 100%"
                                class="js-example-basic-single select2-hidden-accessible" id="direktur">
                                <option value="">PILIH DOSEN</option>
                                @if (isset($dosen)) 
                                    @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-inverse-primary mt-2 text-center" id="skSubmit">
                                Set
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Auth::user()->role == 'KAPRODI')
        <div class="modal fade" id="exampleModalKaprodi" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Progress Persetujuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="" id="formSetDosbing">
                        <div class="modal-body">
                            @csrf
                            {{-- @foreach ($kaprodi as $item) --}}
                            <input type="hidden" name="id" id="id_mbkm" value="">
                            <h4 id="titleSetDosbing">Set Dosen Pembimbing untuk </h4><br>
                            {{-- @endforeach --}}
                            <div class="table-responsive">
                                <select required name="dosen" style="width: 100%"
                                    class="js-example-basic-single select2-hidden-accessible" id="">
                                    <option value="">---PILIH DOSEN PEMBIMBING---</option>
                                    @if (isset($dosen)) 
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="setDosbingSubmit" class="btn btn-inverse-primary">Pilih</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'PIC' || Auth::user()->pic)
        <div class="modal fade" id="exampleModalPicNilai" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Penilaian MBKM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/pic/nilai" method="POST" id="formPicNilai">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id_mbkmpic" id="id_mbkmpic" value="">
                            <div class="form-group">
                                <label for="exampleInputNilaiDOsbing"><b>Nilai Dosen Pembimbing</b></label>
                                <input type="number" class="form-control" name="nilai_dosbing" id="nilai_dosbing" cols="30" rows="10" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputNilaiPemlap"><b>Nilai Pembimbing Lapangan</b></label>
                                <input type="number" class="form-control" name="nilai_pemlap" id="nilai_pemlap" cols="30" rows="10" value=""/>
                            </div>
                            <small>Rentang nilai: 0 - 100</small>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="PicNilaiSubmit" class="btn btn-inverse-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->role == 'KAPRODI' || Auth::user()->role == 'KAJUR' || Auth::user()->role == 'PIMPINAN')
    <div class="modal fade" id="exampleModalFilterExport" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" style="display: none" id="alertChange"></div>
                    <span id="progressChange" style="display: none">Proses...</span>
                    <form action=" 
                    @if(Auth::user()->role == 'PIMPINAN')
                    /export
                    @elseif(Auth::user()->role == 'KAJUR')
                    /exportkajur
                    @elseif(Auth::user()->role == 'KAPRODI')
                    /exportprodi
                    @endif" 
                    method="GET">
                        @csrf
                        <div class="form-group" id="div_tahun">
                            <label for="">Tahun</label>
                            <div class="table-responsive">
                                <select required name="tahun" style="width: 100%"
                                    class="js-example-basic-single select2-hidden-accessible" id="tahun">
                                    <option value="">---PILIH TAHUN---</option>
                                    @if(isset($tahun))
                                        @foreach($tahun as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="div_jurusan">
                            <label for="">Jurusan</label>
                            <div class="table-responsive">
                                <select name="jurusan" style="width: 100%"
                                    class="js-example-basic-single select2-hidden-accessible" id="jurusan">
                                    <option value="">---PILIH JURUSAN---</option>
                                    @if(isset($jurusan))
                                        @foreach($jurusan as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="div_prodi">
                            <label for="">Prodi</label>
                            <div class="table-responsive">
                                <select name="prodi" style="width: 100%"
                                    class="js-example-basic-single select2-hidden-accessible" id="prodi">
                                    <option value="">---PILIH PRODI---</option>
                                    @if(isset($prodi))
                                        @foreach($prodi as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-inverse-primary" id="btn-filter-export">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('partials.footer')
    @yield('js')
    <script>
        $( function() {
          $( ".edit-date" ).datepicker({
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
          });
        } );
    </script>
    <script>
        $("#change-pass").click(function(e) {
            e.preventDefault();
            $("#exampleModalChangePass").modal("show")
        });
        $("#btn-change-pass").click(function() {
            var pass = $("#pass").val();
            var pass_old = $("#pass_old").val()
            var ver = $("#ver_pass").val()
            var progress = $("#progressChange")
            var alert = $("#alertChange")
            progress.css("display", "block")
            alert.css("display", "none")
            fetch("/change-pass/" + pass + "/" + pass_old + "/" + ver).then((res) => res.json()).then(
                result => {
                    if (result.success == 1) {
                        progress.css("display", "none")
                        alert.css("display", "block")
                        alert.html(result.message)
                        alert.addClass("alert alert-success")
                    } else {
                        progress.css("display", "none")
                        alert.css("display", "block")
                        alert.html(result.message)
                        alert.addClass("alert alert-danger")
                    }
                })
        })
        $("#laporan").on("change", function (e) {
            var files = e.currentTarget.files;
            for (var x in files) {
                var filesize = ((files[x].size/1024)/1024).toFixed(4); // MB
                if (files[x].name != "item" && typeof files[x].name != "undefined" && filesize >= 5) { 
                    Swal.fire({icon: 'warning', title: 'Ukuran file terlalu besar!'});
                    this.value = "";
                }
            }
        });
        $('#skSubmit').on("click",function(e) {
            $('#exampleModalSK').modal('hide'); //or  $('#IDModal').modal('hide');
        });
        $('#setDosbingSubmit').on('click', function(e){
            e.preventDefault()
            var formData = $('#formSetDosbing').serializeArray();

            // Convert the form data to a JavaScript object
            var formDataObject = {};
            $.each(formData, function (i, field) {
                formDataObject[field.name] = field.value;
            });
            $.ajax({
            type: "POST",
            url: "/api/setDosbing",
            data: formDataObject,
            success: function(response) {
                Swal.fire({
                    title: "Set Dosbing Berhasil",
                    icon: "success",
                    width: '400px'
                });
                // console.log(response);
                setTimeout(() => {location.reload()}, 2000);
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

        })
        $('#role_baru').on('change', function(e){
            e.preventDefault()
            let role = $(this).select2('data')
            console.log(role)
            if(role[0].text == "PIC"){
                $('#jenis_pic').css('display', 'block')
            } else {
                $('#jenis_pic').css('display', 'none')
            }
            if(role[0].text == "Kaprodi"){
                $('#div_prodi').css('display', 'block')
            } else {
                $('#div_prodi').css('display', 'none')
            }
            if(role[0].text == "Kajur"){
                $('#div_jurusan').css('display', 'block')
            } else {
                $('#div_jurusan').css('display', 'none')
            }
        })
    </script>
    <!-- End custom js for this page-->
</body>

</html>
