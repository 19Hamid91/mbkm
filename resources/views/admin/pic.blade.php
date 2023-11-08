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
        <a type="button" class="btn btn-inverse-primary btn-md ml-auto mr-3 mb-3" id="addPIC" data-toggle="modal"
            data-target="#exampleModalAddPIC"
            style="padding: 10px"><b>Tambah</b>
        </a>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data PIC</h4>
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
                                        <th>No</th>
                                        <th>Nama PIC</th>
                                        <th>Program</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pic as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jenis_pic }}</td>
                                        <td>{{ $item->typeProgram->nama }}</td>
                                        <td>
                                            <a type="button" class="btn bg-danger btn-md ml-auto mr-3" id="delete_data" style="padding: 10px" data-id="{{$item->id}}"><b>Delete</b></a>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    $( document ).ready(function() {
            fetch("/api/getAllDosen/pic")
                        .then((res)=>res.json())
                        .then(result=>{
                                    if(result.success===1){
                                        // console.log(result.data.length);
                                        for(let i=0;i<result.data.length;i++){
                                            $('#dosen_pic').append('<option data-userrole="'+result.data[i].role+'" value="'+result.data[i].email+'">'+result.data[i].name+'</option>')
                                        }

                                           
                                }
                            })
        });
        $('#myTable').DataTable()
        function titleCase(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
            }
            return splitStr.join(' '); 
        }
        $('#myTable').on('click','#delete_data', function(e){
            e.preventDefault();
            var id = $(this).data('id')
            swal({
                    title: "Warning?",
                    text: "Delete data PIC?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/admin/deletePic/"+id,{
                            method: "POST"
                        })
                        .then((res)=>res.json())
                        .then(result=>{
                                    if(result.success===1){
                                            swal(result.message, {
                                                    icon: "success",
                                                });
                                                setTimeout(() => {
                                                    location.reload()
                                    }, 2000);
                                } else {
                                    swal(result.message, {
                                                    icon: "danger",
                                                });
                                                setTimeout(() => {
                                                    location.reload()
                                    }, 2000);
                                }
                            })
                    }})
        })
    </script>
@endsection
