@extends('user.layout.master')

@section('title', 'Change Password')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="title-2">
                                            <span class="col-2">
                                                <a href="{{ route('user#home') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-1">Change Password</span>
                                        </h3>
                                    </div>
                                    <hr>
                                    @if (session('changesuccess'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-check"></i> {{ session('changesuccess') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('changefail'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('changefail') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('user#passwordchange') }}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                            <div class="invalid-feedback text-danger">
                                                @error('old_password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                            <div class="invalid-feedback text-danger">
                                                @error('new_password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                            <div class="invalid-feedback text-danger">
                                                @error('confirm_password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark text-light btn-block">
                                                <span id="payment-button-amount"><i class="fa-solid fa-key me-2"></i>Change</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
