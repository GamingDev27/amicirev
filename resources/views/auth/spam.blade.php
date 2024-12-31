@extends('layouts.app')

@section('content')
<section class="page-section" id="services">
    <br />
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-danger m-1">

                    {{ __('SPAM DETECTED') }}

                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center p-4">
                        <i class='fas fa-exclamation-triangle' style='font-size:48px;color:red'></i>
                        <div class="ml-3">Your action was flag as a spam attack. If you think this is a false flag,
                            contact the Amici
                            Review Center.</div>
                    </div>
                    <form method="GET" action="{{ route('home') }}" id="spam-return" novalidate>
                        @csrf
                        <div class="form-group row mt-2 mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary btn-block">
                                    {{ __('Return') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>