@extends('layouts.app')
@section('tl')
    Dashboard Direktur
@endsection
@section('content')
<style>.swal-modal .swal-text {
    text-align: center;
}</style>
    <div class="row">
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <select required id="tahunAll" name="tahunAll" style="width: 10%" class="js-example-basic-single select2-hidden-accessible">
                                <option value="">Tahun</option>
                                @foreach ($tahun as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <button data-id="" id="filterAll" type="button"
                                class="btn btn-inverse-info btn-md" ><b>Filter</b>
                            </button>
                        </div>
                    </div>  
                <center>
                    <h4 class="card-title">Data Semua Jurusan</h4>
                    <div id="divAll" style="width: 80%;"><canvas id="chartAll"></canvas></div>
                </center>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <select required id="tahunJurusan" name="tahunJurusan" style="width: 30%" class="js-example-basic-single select2-hidden-accessible">
                                <option value="">Tahun</option>
                                @foreach ($tahun as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <select required id="dashboardjurusan" name="dashboardjurusan" style="width: 50%" class="js-example-basic-single select2-hidden-accessible">
                                <option value="">--Jurusan--</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <button data-id="" id="filterJurusan" type="button"
                                class="btn btn-inverse-info btn-md" ><b>Filter</b>
                            </button>
                        </div>
                    </div>
                <center>
                    <h4 class="card-title">Data Per Jurusan</h4>
                    <div id="divJurusan" style="width: 100%;"><canvas id="chartJurusan"></canvas></div>
                </center>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <select required id="tahunProdi" name="tahunProdi" style="width: 30%" class="js-example-basic-single select2-hidden-accessible">
                                <option value="">Tahun</option>
                                @foreach ($tahun as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <select required id="dashboardprodi" name="dashboardprodi" style="width: 50%" class="js-example-basic-single select2-hidden-accessible">
                                <option value="">--Prodi--</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <button data-id="" id="filterProdi" type="button"
                                class="btn btn-inverse-info btn-md" ><b>Filter</b>
                            </button>
                        </div>
                    </div>
                <center>
                    <h4 class="card-title">Data Per Prodi</h4>
                    <div id="divProdi" style="width: 100%;"><canvas id="chartProdi"></canvas></div>
                </center>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $( document ).ready(function() {
            var year = new Date().getFullYear();
            fetch("/api/pimpinan/dataAll/"+year).then((res)=>res.json()).then(result=>{
                if(result.success===1){
                    new Chart(
                    document.getElementById('chartAll'),
                    {
                    type: 'bar',
                    destroy: true,
                    data: {
                        labels: Object.keys(result.data),
                        datasets: [
                        {
                            label: 'Jumlah Mahasiswa',
                            data: Object.values(result.data),
                            backgroundColor: '#3d80eb'
                        }
                        ]
                    }
                    }
                );
                }
            })
            fetch("/api/pimpinan/dataJurusan/"+year+"/Teknik Elektro").then((res)=>res.json()).then(result=>{
                if(result.success===1){
                    console.log(Object.keys(result.data));
                    new Chart(
                    document.getElementById('chartJurusan'),
                    {
                    type: 'bar',
                    destroy: true,
                    data: {
                        labels: Object.keys(result.data),
                        datasets: [
                        {
                            label: 'Jumlah Mahasiswa',
                            data: Object.values(result.data),
                            backgroundColor: '#3d80eb'
                        }
                        ]
                    }
                    }
                );
                }
            })
            fetch("/api/pimpinan/dataProdi/"+year+"/Teknik Telekomunikasi").then((res)=>res.json()).then(result=>{
                if(result.success===1){
                    console.log(Object.keys(result.data));
                    new Chart(
                    document.getElementById('chartProdi'),
                    {
                    type: 'bar',
                    destroy: true,
                    data: {
                        labels: Object.keys(result.data),
                        datasets: [
                        {
                            label: 'Jumlah Mahasiswa',
                            data: Object.values(result.data),
                            backgroundColor: '#3d80eb'
                        }
                        ]
                    }
                    }
                );
                }
            })
        })
    </script>
    <script>
        //filter
        $("#filterAll").on("click", function(e){
            e.preventDefault();
            var tahun = $('#tahunAll').val();
            fetch("/api/pimpinan/dataAll/"+tahun).then((res)=>res.json()).then(result=>{
                if(result.success===1){
                    $('#chartAll').remove(); $('#divAll').append('<canvas id="chartAll"><canvas>');
                    new Chart(
                    document.getElementById('chartAll'),
                    {
                    type: 'bar',
                    destroy: true,
                    data: {
                        labels: Object.keys(result.data),
                        datasets: [
                        {
                            label: 'Jumlah Mahasiswa',
                            data: Object.values(result.data),
                            backgroundColor: '#3d80eb'
                        }
                        ]
                    }
                    }
                );
                }
            })
        });
        $("#filterJurusan").on("click", function(e){
            e.preventDefault();
            var tahun = $('#tahunJurusan').val();
            var jurusan = $('#dashboardjurusan').val();
            fetch("/api/pimpinan/dataJurusan/"+tahun+"/"+jurusan).then((res)=>res.json()).then(result=>{
                if(result.success===1){
                    $('#chartJurusan').remove(); $('#divJurusan').append('<canvas id="chartJurusan"><canvas>');
                    new Chart(
                    document.getElementById('chartJurusan'),
                    {
                    type: 'bar',
                    destroy: true,
                    data: {
                        labels: Object.keys(result.data),
                        datasets: [
                        {
                            label: 'Jumlah Mahasiswa',
                            data: Object.values(result.data),
                            backgroundColor: '#3d80eb'
                        }
                        ]
                    }
                    }
                );
                }
            })
        });
        $("#filterProdi").on("click", function(e){
            e.preventDefault();
            var tahun = $('#tahunProdi').val();
            var prodi = $('#dashboardprodi').val();
            fetch("/api/pimpinan/dataProdi/"+tahun+"/"+prodi).then((res)=>res.json()).then(result=>{
                if(result.success===1){
                    $('#chartProdi').remove(); $('#divProdi').append('<canvas id="chartProdi"><canvas>');
                    new Chart(
                    document.getElementById('chartProdi'),
                    {
                    type: 'bar',
                    destroy: true,
                    data: {
                        labels: Object.keys(result.data),
                        datasets: [
                        {
                            label: 'Jumlah Mahasiswa',
                            data: Object.values(result.data),
                            backgroundColor: '#3d80eb'
                        }
                        ]
                    }
                    }
                );
                }
            })
        });
    </script>
@endsection
