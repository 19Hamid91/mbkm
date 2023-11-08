@extends('layouts.app')
@section('tl')
    Dashboard Admin
@endsection
@section('content')
<style>
.swal-modal .swal-text {
    text-align: center;
}
#ubah_role {
    margin-bottom: 10px;
}
</style>
<div class="row">
    <a type="button" class="btn btn-inverse-primary btn-md ml-auto mr-3" id="ubah_role"
    data-role="KAPRODI" data-toggle="modal"
    data-target="#exampleModalChangeRole"
    style="padding: 10px"><b>Tambah</b></a>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pengaturan Role</h4>
                    <div class="btn-group d-flex align-items-center justify-content-center mb-3" role="group" aria-label="Basic example">
                        <a href="" class="btn btn-inverse-primary btnNav active" data-role="KAPRODI" id="kaprodiBtn">Kaprodi</a>
                        <a href="" class="btn btn-inverse-primary btnNav" data-role="KAJUR" id="kajurBtn">Kajur</a>
                        <a href="" class="btn btn-inverse-primary btnNav" data-role="PIC" id="picBtn">PIC</a>
                        <a href="" class="btn btn-inverse-primary btnNav" data-role="PIMPINAN" id="direkturBtn">Pimpinan</a>
                        <a href="" class="btn btn-inverse-primary btnNav" data-role="ADMIN" id="adminBtn">Admin</a>
                    </div>
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
                                        <th class="pic" >PIC</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
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
            fetch("/api/getAllDosen/all")
                        .then((res)=>res.json())
                        .then(result=>{
                                    if(result.success===1){
                                        // console.log(result.data.length);
                                        for(let i=0;i<result.data.length;i++){
                                            $('#dosen').append('<option data-userrole="'+result.data[i].role+'" value="'+result.data[i].email+'">'+result.data[i].name+'</option>')
                                        }

                                           
                                }
                            })
            $('#myTable').DataTable( {
            destroy: true,
            ajax: {
                url: '/api/getDosen/kaprodi',
                dataSrc: 'data'
            },
            columns: [
            { data: 'pic',"defaultContent": "" },
            { data: 'name',"defaultContent": "" },
            { data: 'email',"defaultContent": "" },
            { data: null,
                "mRender": function ( source ) {
                    return '<button id="removeBtn" class="btn btn-inverse-danger" data-nmdosen="'+source.name+'" data-dosenid='+source.id+'>Remove</button>';
                }}
            ],
            columnDefs: [
                { "visible": false, "targets": 0 }
              ],
            success: function (data) {
            $('#kajur').DataTable().clear().draw();
            $('#kajur').DataTable().rows.add(data).draw();
            },
            error: function (error) {
                console.log('Error:', error);
            }
        } );
        });

        const links = document.querySelectorAll('.btnNav');
    
        if (links.length) {
        links.forEach((link) => {
            link.addEventListener('click', (e) => {
            links.forEach((link) => {
                link.classList.remove('active');
            });
            e.preventDefault();
            link.classList.add('active');
            });
        });
        }

        $("#kajurBtn, #kaprodiBtn, #direkturBtn, #adminBtn, #picBtn").on("click", function(e) {
            var role = $(this).data('role');
            var pic = role == "PIC" ? true : false;
            e.preventDefault(),
            $('#myTable').DataTable( {
            destroy: true,
            ajax: {
                url: '/api/getDosen/'+role,
                dataSrc: 'data'
            },
            columns: [
            { data: 'pic.jenis_pic',"defaultContent": "" },
            { data: 'name',"defaultContent": "" },
            { data: 'email',"defaultContent": "" },
            { data: null,
                "mRender": function ( source ) {
                    return '<button id="removeBtn" class="btn btn-inverse-danger" data-nmdosen="'+source.name+'" data-dosenid='+source.id+'>Remove</button>';
                }}
            ],
            columnDefs: [
                { "visible": pic, "targets": 0 }
              ],
            success: function (data) {
            $('#kajur').DataTable().clear().draw();
            $('#kajur').DataTable().rows.add(data).draw();
            },
            error: function (error) {
                console.log('Error:', error);
            }
        } );
        })
        // $('#picBtn').on('click', function(e){
        //     e.preventDefault()
            
        // })

        $('#dosen').on('change', function(event) {
            var userRole = event.target.options[event.target.selectedIndex].dataset.userrole;
            console.log('User Role:', userRole);
            $(".modal-body #role_lama").val(userRole);
        });

        function titleCase(str) {
        var splitStr = str.toLowerCase().split(' ');
        for (var i = 0; i < splitStr.length; i++) {
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
        }
        return splitStr.join(' '); 
        }

        $("#myTable").on("click", "#removeBtn", function(e) {
            var dosenId = $(this).data('dosenid')
            var nmDosen = $(this).data('nmdosen');
            nmDosen = titleCase(nmDosen)

            e.preventDefault()
            swal({
                    title: "Warning?",
                    text: "Anda Yakin Ingin Menghapus Role Dari "+nmDosen+"?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch("/api/changeToDosen/"+dosenId)
                        .then((res)=>res.json())
                        .then(result=>{
                                    if(result.success===1){
                                            swal(result.message, {
                                                    icon: "success",
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
