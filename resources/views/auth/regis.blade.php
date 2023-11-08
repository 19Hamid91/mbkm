@extends('layouts.login')
@section('content')
    <div class="row w-100 mx-0">

        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/images/logo_mbkm2.png')}}" alt="logo" style="width: 300px;height: auto;"> 
                </div>

                <h6 class="font-weight-light">Sign up to continue.</h6>
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
                <form class="pt-3" action="/regis-act" method="POST">
                    @csrf
                    {{-- <div class="form-group">
                        <input type="text" required class="form-control form-control-lg" name="name" id="exampleInputEmail1"
                            placeholder="Nama">
                    </div> --}}
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-lg" name="nim" id="exampleInputEmail1"
                            placeholder="NIM/NIP">
                    </div>
                    {{-- <div class="form-group">
                        <input type="email" required class="form-control form-control-lg" name="email" id="exampleInputEmail1"
                            placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-lg" name="telp" id="exampleInputEmail1"
                            placeholder="Telephone">
                    </div> --}}
                    <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="password"
                            id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="ver"
                            id="exampleInputPassword1" placeholder="Ulangi Password ">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                            type="submit">SIGN UP</button>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            {{-- <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label> --}}
                        </div>
                        {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                    </div>
                    {{-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> --}}
                    <div class="text-center mt-4 font-weight-light">
                        Already have an account? <a href="/login" class="text-primary">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
