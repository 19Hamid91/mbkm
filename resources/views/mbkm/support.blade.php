@extends('layouts.app')
@section('tl')
    File Dukung
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upload File Pendukung</h4>
                    <p class="card-description text-danger">
                        Format .pdf max 5MB
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
                        @if ($type=="in")
                            <form action="/mbkm/support/act" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{ $id }}">
                                @csrf
                                <table class="table table-hover">
                                
                                <tbody>
                                    <tr>
                                        <td><b>Transkrip Nilai<span class="text-danger">*</span></b><br></td>
                                        <td>
                                           <td>
                                            @if ($data[0]!=null)
                                                <label class="badge badge-success">Success</label>
                                            @else
                                                <label class="badge badge-danger">Pending</label>
                                            @endif
                                           </td>
                                        </td>
                                        <td>
                                           <input type="file" accept="application/pdf" name="nilai" class="form-control" id="nilai">
                                           <input type="hidden" name="nilai_hid" value="{{ $data[0] }}">
                                        </td>
                                
                                    </tr>
                                    <tr>
                                        <td><b>Surat Pakta Integritas<span class="text-danger">*</span></b><br><a href="/mbkm/template/pakta" target="_blank">Download Template Surat Pakta Integritas</a></td>
                                        <td>
                                           <td>
                                            @if ($data[1]!=null)
                                                <label class="badge badge-success">Success</label>
                                            @else
                                                <label class="badge badge-danger">Pending</label>
                                            @endif
                                           </td>
                                        </td>
                                        <td>
                                           <input type="file" accept="application/pdf" name="pakta" class="form-control" id="">
                                           <input type="hidden" name="pakta_hid" value="{{ $data[1] }}">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Surat Rekomendasi Perguruan Tinggi Asal<span class="text-danger">*</span></b><br><a href="/mbkm/template/rekomendasi" target="_blank">Download Template Surat Rekomendasi Perguruan Tinggi Asal</a></td>
                                        <td>
                                           <td>
                                            @if ($data[2]!=null)
                                                <label class="badge badge-success">Success</label>
                                            @else
                                                <label class="badge badge-danger">Pending</label>
                                            @endif
                                           </td>
                                        </td>
                                        <td>
                                           <input type="file" accept="application/pdf" name="surat_rekom" class="form-control" id="">
                                           <input type="hidden" name="surat_rekom_hid" value="{{ $data[2] }}">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Surat Rekomendasi Persetujuan Orang Tua<span class="text-danger">*</span></b><br><a href="/mbkm/template/ortu" target="_blank">Download Template Surat Rekomendasi Persetujuan Orang Tua</a></td>
                                        <td>
                                           <td>
                                            @if ($data[3]!=null)
                                                <label class="badge badge-success">Success</label>
                                            @else
                                                <label class="badge badge-danger">Pending</label>
                                            @endif
                                           </td>
                                        </td>
                                        <td>
                                           <input type="file" accept="application/pdf" name="surat_persetujuan_ortu" class="form-control" id="">
                                           <input type="hidden" name="surat_persetujuan_ortu_hid" value="{{ $data[3] }}">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Surat Keterangan Sehat</b><br>
                                            {{-- <a href="/mbkm/template/sehat" target="_blank">Download Template Surat Keterangan Sehat</a> --}}
                                        </td>
                                        <td>
                                           <td>
                                            @if ($data[4]!=null)
                                                <label class="badge badge-success">Success</label>
                                            @else
                                                <label class="badge badge-danger">Pending</label>
                                            @endif
                                           </td>
                                        </td>
                                        <td>
                                           <input type="file" accept="application/pdf" name="ket_sehat" class="form-control" id="">
                                           <input type="hidden" name="ket_sehat_hid" value="{{ $data[4] }}">
                                        </td>
                                    </tr>
                                </tbody>
                                                        </table>
                                <button class="btn btn-primary btn-md float-right mt-3" type="submit">Upload</button>
                            </form>
                        @else
                            
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("input").on("change", function (e) {
            var files = e.currentTarget.files;
            for (var x in files) {
                var filesize = ((files[x].size/1024)/1024).toFixed(4); // MB
                if (files[x].name != "item" && typeof files[x].name != "undefined" && filesize >= 5) { 
                    Swal.fire({icon: 'warning', title: 'Ukuran file terlalu besar!'});
                    this.value = "";
                }
            }
        });
    </script>
@endsection
