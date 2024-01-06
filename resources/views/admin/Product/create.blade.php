@extends('admin.layouts.master')

@section('title', 'Create Product')

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
                                                <a href="{{ route('product#list') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-1">Create Product</span>
                                        </h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('create#product') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Name...">
                                            @error('name')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="category" class="form-select @error('category') is-invalid @enderror " value="{{ old('category') }}">
                                                <option value="">Choose Category</option>
                                                @foreach ($datas as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="10" rows="5">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Image</label>
                                            <input id="cc-pament" name="image" type="file" class="form-control @error('image') is-invalid @enderror " aria-required="true" aria-invalid="false">
                                            @error('image')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" aria-required="true" aria-invalid="false" placeholder="Price...">
                                            @error('price')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Wating Time</label>
                                            <input id="cc-pament" name="wating_time" type="number" class="form-control @error('wating_time') is-invalid @enderror "value="{{ old('wating_time') }}"  aria-required="true" aria-invalid="false" placeholder="Wating Time">
                                            @error('wating_time')
                                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
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
