@extends('layouts.app')
@section('tl')
    Registrasi MBKM
@endsection
@section('content')
<img style="position:fixed; left:0; right:0; margin:0 auto;z-index:1;max-width:10%;height:auto;display:;" id="loading" src="{{ asset('img/loading.gif')}}" alt="Loading..." />
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Pendaftaran Merdeka Belajar Di luar Program Studi</h4>
                    <p class="card-description">
                        Pendaftaran MBKM
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
                    <form id="mbkm" class="forms-sample" action="/mbkm/register" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lastUrl" value="{{ URL::previous() }}">
                        <input type="hidden" name="t" value="in">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Program Studi Asal </label>
                            <input type="text" class="form-control" id="prodi" name="prodi" value="{{ $mahasiswa->prodi }}" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputIPK">IPK</label>
                            <input type="text" class="form-control" id="ipk" name="ipk" value="{{ round($ipk, 2) }}" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Jenis Program Merdeka Belajar <span
                                    class="text-danger"><b>*</b></span></label>
                            <select name="program" id="program" style="width: 100%" required
                                class="js-example-basic-single select2-hidden-accessible" id="">
                                <option value="">---PILIH PROGRAM---</option>
                                @foreach ($program as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group" id="kkn" style="display: none">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Sumber Pendanaan <span
                                        class="text-danger"><b>*</b></span></label>
                                <input type="text" class="form-control" id="dana" name="dana"
                                    placeholder="Dana" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Jumlah Anggota <span
                                        class="text-danger"><b>*</b></span></label>
                                <input type="text" class="form-control" id="jumlah_anggota" name="jumlah_anggota"
                                    placeholder="Jumlah Anggota" readonly/>
                            </div>
                            <div class="form-group" id="div_anggota">
                                <label for="exampleInputUsername1">Nama Anggota <span
                                        class="text-danger"><b>*</b></span></label>
                                        {{-- <div class="input-group mb-1"> --}}
                                            {{-- <input type="text" class="form-control" id="nama_anggota" name="nama_anggota[]"
                                                placeholder="Nama Anggota" />
                                            <a class="btn btn-danger ml-1" id="btnDelete">delete</a> --}}
                                            <select name="nama_anggota[]" id="nama_anggota" style="width: 100%" 
                                                class="js-example-basic-single select2-hidden-accessible" id="" multiple="multiple">
                                                <option></option>
                                                @foreach ($allMhs as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        {{-- </div> --}}
                            </div>
                            {{-- <button type="button" id="btn_anggota" class="btn btn-inverse-primary mt-2">Tambah</button> --}}
                        </div>
                        <div class="form-group" id="pertukaran" style="display: none">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Jenis Pertukaran Pelajar <span
                                        class="text-danger"><b>*</b></span></label>
                                <select name="pertukarann_pelajar" id="pertukaran_pelajar" style="width: 100%" 
                                    class="js-example-basic-single select2-hidden-accessible" id="">
                                    <option value="">---PILIH PROGRAM---</option>
                                    @foreach ($swap as $item)
                                        <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1" class="mb-0">Nama Program Studi Tujuan <span
                                        class="text-danger"><b>*</b></span></label><br>
                                <small class="text-danger">Contoh: D3 Teknik Informatika</small>
                                <input type="text" class="form-control" id="program-studi"
                                    name="nama_program_studi_tujuan" placeholder="Nama Program Studi Tujuan" />
                            </div>
                            <div class="form-group" id="div_pertukaran">
                                <label for="exampleInputUsername1" class="mb-0">Mata Kuliah (Kode-NamaMatakuliah JumlahSKS) <span
                                        class="text-danger"><b>*</b></span></label><br>
                                        <small class="text-danger">Contoh: 34242-Pemrograman Perangkat Bergerak 3</small>
                                <input type="text" class="form-control" id="nama_matkul" name="nama_matkul[]"
                                    placeholder="Nama Matkul" />
                            </div>
                            <button type="button" id="btn_pertukaran" class="btn btn-inverse-primary mt-2">Tambah</button>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alasan Memilih Program <span
                                    class="text-danger"><b>*</b></span></label>
                            <input type="text" class="form-control" id="alasan" name="alasan" required
                                placeholder="Alaasan" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1" class="mb-0">Judul Program/Kegiatan<span
                                    class="text-danger"><b>*</b></span></label><br>
                            <small class="text-danger">Contoh: Magang Bersertifikat I</small>
                            <input type="text" class="form-control" name="judul_program" required id="judul_program"
                                placeholder="Judul Program/Kegiatan" />
                        </div>
                        <div class="form-group" id="lembaga">
                            <label for="exampleInputConfirmPassword1" class="mb-0">Nama Lembaga Mitra</label><br>
                            <small class="text-danger">Contoh: PT Sinar Bangsa</small>
                            <input type="text" name="nama_lembaga" class="form-control" id="nama_lembaga"
                                placeholder="Nama Lembaga Mitra" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTglAwal">Tanggal Awal<span
                                class="text-danger"><b>*</b></span></label>
                            <input name="TglAwal" class="form-control" id="TglAwal"
                                placeholder="Tanggal Awal" />
                        </div>
                        <div id="divTglAkhir" class="form-group" style="display: none">
                            <label for="exampleInputTglAkhir">Tanggal Akhir<span
                                class="text-danger"><b>*</b></span></label>
                            <input name="TglAkhir" class="form-control" id="TglAkhir"
                                placeholder="Tanggal Akhir" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Durasi</label>
                            <div class="form-group">
                                <div class="input-group">

                                    <input id="durasi" type="number" class="form-control" name="durasi"
                                        aria-label="Amount (to the nearest dollar)" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><b>Bulan</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Rincian Kegiatan <span
                                    class="text-danger"><b>*</b></span></label>
                            <textarea name="rincian" id="rincian" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        @if($mahasiswa->ipk < 2.75)
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1" class="mb-0 pb-0">Portofolio <span
                                    class="text-danger mb-0 pb-0"><b>*</b></span></label><br>
                            <small class="text-danger">file pdf max 5MB</small>
                            <input type="file" accept="application/pdf" name="portofolio" class="form-control" id="portofolio" required>
                        </div>
                        @endif
                        <button id="submitForm" type="submit" class="btn btn-primary mr-2">
                            Submit
                        </button>
                        <button class="btn btn-light"><a href="/mbkm/in">Cancel</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    $(document).ready(function(){
        $('#loading').hide();
    })
    $('#mbkm').on('submit', function(){
        $('#loading').show();
    })
    $(window).bind("pageshow", function(event) {
        $("#loading").hide();
    });
    $( function() {
      $( "#TglAwal, #TglAkhir" ).datepicker({
        dateFormat: "yy-mm-dd",
        showButtonPanel: true,
      });
      $("#nama_anggota").select2({
            placeholder: "Pilih Anggota KKN"
        });
    } );
    </script>
    <script>
        function monthDiff(d1, d2) {
            var months;
            months = (d2.getFullYear() - d1.getFullYear()) * 12;
            months -= d1.getMonth();
            months += d2.getMonth();
            return months <= 0 ? 0 : months;
        }
        $("#portofolio").on("change", function (e) {
            var files = e.currentTarget.files;
            for (var x in files) {
                var filesize = ((files[x].size/1024)/1024).toFixed(4); // MB
                if (files[x].name != "item" && typeof files[x].name != "undefined" && filesize >= 5) { 
                    Swal.fire({icon: 'warning', title: 'Ukuran file terlalu besar!'});
                    this.value = "";
                }
            }
        });
        
        $("#program").change(function(e) {
            e.preventDefault();
            var kkn = $("#kkn")
            var pertukaran = $("#pertukaran")
            // console.log(kkn);
            // console.log($(this).val());
            var getValue = $(this).val();
            if (getValue == 5) {
                // console.log(getValue);
                kkn.css("display", "block")
            } else {
                kkn.css("display", "none")
            }
            if (getValue == 8) {
                // console.log(getValue);
                pertukaran.css("display", "block")
            } else {
                pertukaran.css("display", "none")
            }
            if (getValue == 3) {
                console.log(getValue);
                $('#lembaga').children('label').text("Nama Perguruan Tinggi Pelaksana")
                $('#lembaga').children('small').text("Contoh: Politeknik Negeri Semarang")
                $('#lembaga').children('input').attr('placeholder',"Nama Perguruan Tinggi Pelaksana")
            } else {
                $('#lembaga').children('label').text("Nama Lembaga Mitra")
                $('#lembaga').children('small').text("Contoh: PT Sinar Bangsa")
                $('#lembaga').children('input').attr('placeholder',"Nama Lembaga Mitra")
            }
        });
        var inputCount = 0;
        $("#btn_anggota").click(function(e) {
            e.preventDefault();
            var parent = $("#div_anggota")
            // var element =
            // "<input type='text' class='form-control mt-2' id='nama_anggota' name='nama_anggota[]' placeholder='Nama Anggota' />"
            var element = "<div class=\"input-group mb-1\"><input type=\"text\" class=\"form-control\" id=\"nama_anggota\" name=\"nama_anggota[]\" placeholder=\"Nama Anggota\" /><a class=\"btn btn-danger ml-1\"  id=\"btnDelete\">delete</a></div>"
            parent.append(element)
            inputCount = $("input[id^=nama_anggota]").length
            $('#jumlah_anggota').val(inputCount)
            if (inputCount >= 10) {
                $('#btn_anggota').hide()
            }
            // console.log(inputCount);
        });
        $("#div_anggota").on('click', '#btnDelete', function(e) {
            e.preventDefault()
            $(this).closest('.input-group').remove();
            inputCount = $("input[id^=nama_anggota]").length
            $('#jumlah_anggota').val(inputCount)
            if (inputCount < 10) {
                $('#btn_anggota').show()
            }
        })
        $("#btn_pertukaran").click(function(e) {
            e.preventDefault();
            var parent = $("#div_pertukaran")
            var element =
                "<input type='text' class='form-control mt-2' id='nama_matkul' name='nama_matkul[]' placeholder='Nama Matkul' />"
            parent.append(element)
            // console.log("c");
        });
        $('#TglAwal').on('change', function(e){
            var tglAwal = $('#TglAwal').val();
            $('#divTglAkhir').css("display", "");
            $("#TglAkhir").datepicker("option", "minDate", new Date(tglAwal));

        });
        $('#TglAkhir').on('change', function(e){
            var tglAwal = $('#TglAwal').val();
            var tglAkhir = $(this).val();
            var durasi = monthDiff(new Date(tglAwal), new Date(tglAkhir));
            $('#durasi').val(durasi != 0 ? durasi : 1)
        });
        $('#nama_anggota').on('change', function(){
            let count = $(this).select2('data').length
            $('#jumlah_anggota').val(count)
        })
    </script>
@endsection
