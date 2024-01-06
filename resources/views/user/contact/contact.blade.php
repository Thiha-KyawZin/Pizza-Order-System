@extends('user.layout.master')

@section('title', 'Contact Form')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-4 offset-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="title-2">
                                            <span class="col-2">
                                                <a href="{{ route('user#home') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-1">Contact Form</span>
                                        </h3>
                                    </div>
                                    <hr>

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                            <i class="fa-solid fa-paper-plane"></i> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('user#contactSend') }}" method="post">
                                        @csrf
                                        <div class="">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter Username" value="{{ old('name',Auth::user()->name) }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter Email" value="{{ old('email',Auth::user()->email) }}">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea name="message" id="" cols="10" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Enter Message"></textarea>
                                                @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>
                                            <button class="btn btn-outline-warning col-6 offset-3" type="submit"><span class="text-dark">Send <i class="fa-solid fa-paper-plane ms-1"></i></span></button>
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
