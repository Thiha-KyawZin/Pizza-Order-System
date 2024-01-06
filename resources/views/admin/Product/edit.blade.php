@extends('admin.layouts.master')

@section('title', 'Edit Pizza')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="title-2">
                                            <span class="col-2">
                                                {{-- <a href="{{ route('product#list') }}"><i class="fa-solid fa-left-long text-dark"></i></a> --}}
                                                <i class="fa-solid fa-left-long text-dark" onclick="history.back()"></i>
                                            </span>
                                            <span class="offset-4">Edit Pizza</span>
                                        </h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('update#product') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                <img src="{{ asset('storage/product_image/'.$data->image) }}" alt="John Doe" class=" border rounded border-secondary border-2" />
                                                <div class="mt-3">
                                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-primary col-12" type="submit">Update</button>
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <label>Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Username" value="{{ old('name',$data->name) }}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" id="" cols="10" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description',$data->description) }}</textarea>
                                                    @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                                    <select name="category" class="form-select @error('category') is-invalid @enderror " value="{{ old('category') }}">
                                                        <option value="">Choose Category</option>
                                                        @foreach ($category as $category_data)
                                                            <option value="{{ $category_data->id }}" @if ($data->category_id == $category_data->id) selected @endif >{{ $category_data->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input class="form-control @error('price') is-invalid @enderror" type="price" name="price" placeholder="price" value="{{ old('price',$data->price) }}">
                                                    @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>Watimg Time</label>
                                                    <input class="form-control form-control @error('wating_time') is-invalid @enderror" type="number" name="wating_time" placeholder="09xxxxx" value="{{ old('wating_time',$data->wating_time) }}">
                                                    @error('wating_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>View Count</label>
                                                    <input class="form-control form-control" type="number" name="view_count" disabled value="{{ old('view_count',$data->view_count) }}">
                                                </div><div class="form-group">
                                                    <label>Created at</label>
                                                    <input class="form-control form-control" type="text" name="created_at" disabled value="{{ old('created_at',$data->created_at) }}">
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
