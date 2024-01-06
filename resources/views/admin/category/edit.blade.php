@extends('admin.layouts.master')

@section('title', 'Edit Category')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="title-2">
                                            <span class="col-2 me-4">
                                                <a href="{{ route('category#list') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-1">Edit Category</span>
                                        </h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('update#category') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                <img src="{{ asset('storage/logo_image/'.$data->image) }}" alt="John Doe" class="" />
                                                <div class="mt-3">
                                                    <button class="btn btn-primary col-12" type="submit" id="payment-button">
                                                        <span id="payment-button-amount">Update</span>
                                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                        <i class="fa-solid fa-circle-right"></i>
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="hidden" value="{{ $data->id }}" name="categoryId">
                                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="category_name" value="{{ old('category_name',$data->name) }}" type="text" class="form-control @error('category_name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Name...">
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
                                            </div>
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
