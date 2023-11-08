@extends('layouts.login')
@section('content')
    <div class="row w-100 mx-0">

        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/images/logo_mbkm2.png')}}" alt="logo" style="width: 300px;height: auto;"> 
                </div>

                <h6 class="font-weight-light">Sign in to continue.</h6>
                @if (session('fail'))
                    <div class="alert alert-danger">
                        {{ session('fail') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @else
                @endif
                <form class="pt-3" action="/login-act" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-lg" name="email"
                            id="exampleInputEmail1" placeholder="NIM/NIP">
                        <small class="text-danger">NIM menggunakan titik ( . )</small>
                    </div>
                    {{-- <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="password"
                            id="exampleInputPassword1" placeholder="Password">
                    </div> --}}
                    <div class="mt-3">
                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                            type="submit">SIGN IN</button>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <!--<div class="form-check">-->
                            {{-- <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label> --}}
                        <!--</div>-->
                        <a href="{{ asset('assets/Prosedur Pengisian Pendaftaran MBKM-Mahasiswa.pdf')}}" class="auth-link text-blue" download>Download Panduan</a>
                        <!--<a id="btn-forget" class="auth-link text-blue">Forgot password?</a>-->
                    </div>
                    {{-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> --}}
                    <!--<div class="text-center mt-4 font-weight-light">-->
                    <!--    Don't have an account? <a href="/regis" class="text-primary">Create</a>-->
                    <!--</div>-->
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#btn-forget").click(function(e) {
            e.preventDefault();
            console.log("oke")
            $("#exampleModalForget").modal("show")
        });
        $("#btn-reset").click(function(e) {
            e.preventDefault();
            var getEmail = $("#emailF").val()
            var alert = $("#alertD")
            var progress = $("#progress")
            alert.css("display", "none");
            progress.css("display", "block");
            fetch("/api/forget/" + getEmail).then((res) => res.json()).then(result => {
                if (result.success == 1) {
                    progress.css("display", "none");
                    alert.html(result.message)
                    alert.css("display", "block");
                alert.addClass("alert alert-success");
                }else{
                    progress.css("display", "none");
                    alert.html(result.message)
                    alert.css("display", "block");
                alert.addClass("alert alert-danger");

                }
            })
        });
    </script>
@endsection
