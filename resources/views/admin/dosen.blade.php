@extends('layouts.app')
@section('tl')
    Dashboard Admin
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
                    <h4 class="card-title">Data Dosen</h4>
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
                                        <th>NIP</th>
                                        <th>NIDN</th>
                                        <th>Email</th>
                                        <th>Prodi</th>
                                        <th>Jurusan</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosens as $dosen)
                                    <tr>
                                        <td>{{ $dosen->nama}}</td>
                                        <td>{{ $dosen->nip}}</td>
                                        <td>{{ $dosen->nidn}}</td>
                                        <td>{{ $dosen->email}}</td>
                                        <td>{{ $dosen->prodi}}</td>
                                        <td>{{ $dosen->jurusan}}</td>
                                        <td>{{ $dosen->jabatan}}</td>
                                        <td><a type="button" class="btn bg-gradient-warning btn-md ml-auto mr-3" data-nip="{{ $dosen->nip }}" data-nmdosen="{{ $dosen->nama}}" id="update_data" style="padding: 10px"><b>Update</b></a></td>
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
        $('#myTable').DataTable()
        function titleCase(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
            }
            return splitStr.join(' '); 
        }

        $('#myTable').on('click', '#update_data', function(e){
            e.preventDefault();
            var nip = $(this).data('nip');
            var nmDosen = $(this).data('nmdosen');
            nmDosen = titleCase(nmDosen)
            console.log(nmDosen)
            swal({
                    title: "Warning?",
                    text: "Update data dari Simpeg untuk dosen "+nmDosen+"?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/updateDataDosen/"+nip)
                        .then((res)=>res.json())
                        .then(result=>{
                                    if(result.success===1){
                                            swal(result.message, {
                                                    icon: "success",
                                                });
                                                setTimeout(() => {
                                                    location.reload()
                                    }, 3000);
                                } else {
                                    swal(result.message, {
                                                    icon: "danger",
                                                });
                                                setTimeout(() => {
                                                    location.reload()
                                    }, 3000);
                                }
                            })
                    }})
        });
    </script>
@endsection
