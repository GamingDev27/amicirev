@extends('layouts.app')



@section('content')

<div class="container mt-5 mt-lg-0">

    <div class="row justify-content-center align-items-center " style="height: 100vh;">
        <div
            class="col-10 col-md-8 col-lg-6 col-offset-1 col-md-offset-2 col-lg-offset-3 border border-secondary rounded bg-dark pt-4 pb-2">
            <div class="panel panel-default">
                <div class="h4 panel-heading font-weight-bold text-center text-light text-wrap">
                    Two-Factor Authentication
                </div>

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
                    <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                        {{ csrf_field() }}
                        <div class="row justify-content-center ">
                            <!-- Icons -->
                            <div class="col-12 mb-4 text-center">
                                <i class="fas fa-mobile-alt text-light" style="font-size: 3rem"></i>
                            </div>

                            <label for="one_time_password"
                                class="col-10 control-label text-center text-secondary">Authentication
                                Code</label>

                            <div class="form-row col-10 ">
                                <input id="one_time_password" type="number" class="form-control"
                                    name="one_time_password" required autofocus placeholder="XXXXXX" maxlength="6"
                                    size="6">
                            </div>

                            <div class="form-row col-10 mt-3 mb-1">
                                <button type="submit" class="btn btn-primary btn-block text-dark">
                                    Verify
                                </button>
                            </div>
                            <div class="form-row col-10 mb-3">
                                <a class="btn btn-outline-light btn-text-dark btn-block"
                                    href="{{ route('email.verify.index') }}">Use Email Verification</a>
                            </div>
                            <div class="form-row col-10">
                                <p class="small text-center text-light">
                                    Open your google two factor authentication app to view your Authentication Code
                                    for Amici Review Center.</p>
                            </div>
                            <div class="form-row col-12">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#ShowQrModal">
                                        <i class="fas fa-qrcode text-light" style="font-size: 2rem"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
@include('google2fa.modal-show-qr')
@endsection

@once
@push('scripts')
<script>
    $('#ShowQrModal').on('show.bs.modal', function (event) {
        fetch('{{ route("generate.qr.code") }}')
        .then(response => response.json())
        .then(data => {
            $('#qrImage').children().remove();
            $('#authKey').children().remove();
            $('#qrImage').append(`${data.QR_Image}`);
            $('#authKey').append(`<strong>${data.secret}</strong>`);
        })
        .catch(error => console.error('Error:', error));
    });
			
</script>
@endpush
@endonce