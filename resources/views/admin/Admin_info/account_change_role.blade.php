@extends('admin.layouts.master')

@section('title', 'Change Role')

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
                                                <a href="{{ route('account#list') }}"><i class="fa-solid fa-left-long text-dark"></i></a>
                                            </span>
                                            <span class="offset-4">Change Role</span>
                                        </h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('role#change',$data->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if ($data->image == null)
                                                    @if ($data->gender == 'Male')
                                                        <img src="{{ asset('image/Male_default.jpg') }}" alt="John Doe" class=" border rounded border-secondary border-2" />
                                                    @else
                                                        <img src="{{ asset('image/Female_default.jpg') }}" alt="John Doe" class=" border rounded border-secondary border-2" />
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/profile_image/'.$data->image) }}" alt="John Doe" class=" border rounded border-secondary border-2" />
                                                @endif
                                                <div class="mt-3">
                                                    <button class="btn btn-primary col-11" type="submit">Change Role</button>
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" disabled type="text" name="name" placeholder="Username" value="{{ old('name',$data->name) }}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror" disabled type="email" name="email" placeholder="Email" value="{{ old('email',$data->email) }}">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select name="role" class="form-control" >
                                                        <option value="admin" @if ($data->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea name="address" id="" cols="10" rows="2" class="form-control @error('address') is-invalid @enderror" disabled placeholder="Address">{{ old('address',$data->address) }}</textarea>
                                                    @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control @error('phone') is-invalid @enderror" disabled type="number" name="phone" placeholder="09xxxxx" value="{{ old('phone',$data->phone) }}">
                                                    @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input mt-1" disabled id="inlineRadio1" type="radio" name="gender" value="Male" {{ old('gender',$data->gender) == "Male" ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input mt-1" disabled id="inlineRadio2" type="radio" name="gender" value="Female" @if ($data->gender == 'Female' ) checked @endif>
                                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                                    </div>
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
