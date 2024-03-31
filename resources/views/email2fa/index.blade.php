@extends('layouts.app')



@section('content')

<div class="container mt-20">

    <div class="row justify-content-center align-items-center " style="height: 100vh;">
        <div
            class="col-10 col-md-8 col-lg-6 col-offset-1 col-md-offset-2 col-lg-offset-3 border border-secondary rounded bg-dark pt-4 pb-4">
            <div class="panel panel-default">
                <div class="h4 panel-heading font-weight-bold text-center text-light text-wrap">
                    Verify your Email Address
                </div>
                <hr class="bg-light">

                @if ($message = Session::get('success'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                </div>
                @endif

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('email.verify.post') }}">
                        {{ csrf_field() }}
                        <div class="row justify-content-center ">
                            <p class="text-weight-light text-center text-light">
                                A verification code has been sent to <span class="text-bolder text-warning">{{
                                    substr($email, 0, 3) . '******'
                                    . substr($email, -6) }}</span>. </p>
                            <!-- Icons -->
                            <div class="col-12 mb-4 text-center">
                                <i class="fas fa-envelope text-light" style="font-size: 3rem"></i>
                            </div>

                            <label for="one_time_password"
                                class="col-10 control-label text-center text-secondary mb-4">Check
                                your email and enter the verification code below to verify your credentials. If your
                                email is no longer accessible, use the <span class="text-primary">google
                                    authentication</span> instead.</label>

                            <div class="form-row col-10 ">
                                <input id="code" type="number" class="form-control @error('code') is-invalid @enderror"
                                    name="code" value="{{ old('code') }}" required autocomplete="code" autofocus
                                    placeholder="XXXXXX">

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-row col-10 my-3">
                                <button type="submit" class="btn btn-primary btn-block text-dark">
                                    Verify
                                </button>

                            </div>
                            <div class="form-row col-10 mb-2">
                                <div class="col-12 col-lg-6">
                                    <a class="btn btn-link btn-text-warning btn-block"
                                        href="{{ route('email.verify.resend') }}">Resend Code?</a>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <a class="btn btn-link btn-text-warning btn-block"
                                        href="{{ route('2fa.index') }}">Use Google Auth</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>

@endsection