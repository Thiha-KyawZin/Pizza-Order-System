@extends('admin.layouts.master')

@section('title', 'Create Category')

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
                                            <span class="col-2 me-3">
                                                <a href="{{ route('category#list') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-1">Create Category</span>
                                        </h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('create#category') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Name...">
                                            <div class="invalid-feedback text-danger">
                                                @error('category_name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Image</label>
                                            <input id="cc-pament" name="image" type="file" class="form-control @error('image') is-invalid @enderror " aria-required="true" aria-invalid="false">
                                            @error('image')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block mt-3">
                                                <span id="payment-button-amount">Create</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                <i class="fa-solid fa-circle-right"></i>
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
