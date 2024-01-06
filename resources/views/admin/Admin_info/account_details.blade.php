@extends('admin.layouts.master')

@section('title', 'Accout Info')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-4 offset-6 mb-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show me-5" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="title-2">
                                            <span class="col-2">
                                                <a href="{{ route('category#list') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-1">Account Info</span>
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'Male')
                                                    <img src="{{ asset('image/Male_default.jpg') }}" alt="John Doe" class="rounded border border-secondary border-2"/>
                                                @else
                                                    <img src="{{ asset('image/Female_default.jpg') }}" alt="John Doe" class="rounded border border-secondary border-2"/>
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/profile_image/'.Auth::user()->image) }}" alt="John Doe" class="rounded border border-secondary border-2"/>
                                            @endif
                                        </div>
                                        <div class="col-7 ms-4">
                                            <h4 class="my-1"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h4>
                                            <h4 class="my-1"><i class="fa-solid fa-envelope me-3"></i>{{ Auth::user()->email }}</h4>
                                            <h4 class="my-1"><i class="fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h4>
                                            <h4 class="my-1"><i class="fa-solid fa-phone me-3"></i>{{ Auth::user()->phone }}</h4>
                                            <h4 class="my-1"><i class="fa-solid fa-address-card me-3"></i>{{ Auth::user()->address }}</h4>
                                            <h4 class="my-1"><i class="fa-solid fa-calendar-days me-3"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="offset-9">
                                            <a href="{{ route('account#edit') }}">
                                                <button class="btn btn-secondary btn-lg rounded"><i class="fa-solid fa-pen me-2"></i>Edit</button>
                                            </a>
                                        </div>
                                    </div>
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
