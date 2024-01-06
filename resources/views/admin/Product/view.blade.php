@extends('admin.layouts.master')

@section('title', 'Product Details')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="title-2">
                                            <span class="col-2">
                                                <i class="fa-solid fa-left-long text-dark" onclick="history.back()"></i>
                                            </span>
                                            <span class="offset-1">Pizza Details</span>
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-4 offset-1">
                                            <img src="{{ asset('storage/product_image/'.$data->image) }}" alt="John Doe" class="rounded border border-secondary border-2"/>
                                        </div>
                                        <div class="col-6 ms-4 mb-3">
                                            <h4 class="my-1 btn btn-primary "><i class="fa-solid fa-pizza-slice me-1"></i>Name: {{ $data->name }}</h4>
                                            <h4 class="my-1 btn btn-success "><i class="fa-solid fa-money-bill-1-wave me-1"></i>Price: {{ $data->price }} Kyats</h4>
                                            <h4 class="my-1 btn btn-secondary "><i class="fa-solid fa-clock me-1"></i>Wating Time: {{ $data->wating_time }} Mins</h4>
                                            <h4 class="my-1 btn btn-secondary "><i class="fa-solid fa-list-ul me-1"></i>Category: {{ $data->category_name }}</h4>
                                            <h4 class="my-1 btn btn-secondary "><i class="fa-solid fa-eye me-1"></i>View Count: {{ $data->view_count }}</h4>
                                            <h4 class="my-1 btn btn-secondary "><i class="fa-solid fa-calendar-days me-1"></i>Create Time: {{$data->created_at->format('j-F-Y') }}</h4>
                                        </div>
                                        <div class="col-10 offset-1">
                                            <h2 class="text-decoration-underline text-danger-emphasis">Description</h2>
                                            <h4 class="my-1">{{ $data->description }}</h4>
                                        </div>
                                    </div>
                                    {{-- <div class="row mt-3">
                                        <div class="offset-9">
                                            <a href="{{ route('account#edit') }}">
                                                <button class="btn btn-secondary btn-lg rounded"><i class="fa-solid fa-pen me-2"></i>Edit</button>
                                            </a>
                                        </div>
                                    </div> --}}
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
