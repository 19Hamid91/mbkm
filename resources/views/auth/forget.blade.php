@extends('layouts.login')
@section('content')
    <div class="row w-100 mx-0">

        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                    {{-- <img src="{{ asset('assets/images/logo.svg')}}" alt="logo"> --}}
                </div>

                <h4>Silahkan masukan password baru anda</h4>
                <h6 class="font-weight-light">Untuk melanjutkan progres anda</h6>
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
                <form class="pt-3" action="/forget-act" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $token }}" name="token">
                    <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="password" id="exampleInputEmail1"
                            placeholder="Password Baru">
                    </div>
                    <div class="form-group">
                        <input type="password" required class="form-control form-control-lg" name="ver" id="exampleInputEmail1"
                            placeholder="Ulangi Password">
                    </div>
                    <button type="submit" class="btn btn-inverse-primary float-right">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection