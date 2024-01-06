@extends('admin.layouts.master')

@section('title', 'Admin List')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h3 class="mt-2">Total-{{ $datas->total() }}</h3>
                        </div>
                        <div class="col-3 offset-5">
                            <form class="form-header" action="{{ route('account#list') }}" method="get">
                                @csrf
                                <div class="input-group ">
                                    <input type="text" name="search" class="form-control rounded-start" placeholder="Search" value="{{ request('search') }}" aria-describedby="basic-addon2">
                                    <button class="btn btn-primary rounded-end" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    {{-- Message --}}
                    @if (session('delete'))
                        <div class="alert alert-warning alert-dismissible fade show col-4 offset-8 mt-3" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr class="tr-shadow">
                                            <input type="hidden" id="user_id" value="{{ $data->id }}">
                                            <td class="col-2">
                                                @if ($data->image == null)
                                                    @if ($data->gender == 'Male')
                                                        <img src="{{ asset('image/Male_default.jpg') }}" alt="John Doe" class="rounded border border-secondary"/>
                                                    @else
                                                        <img src="{{ asset('image/Female_default.jpg') }}" alt="John Doe" class="rounded border border-secondary"/>
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/profile_image/'.$data->image) }}" alt="John Doe" class="rounded border border-secondary"/>
                                                @endif
                                            </td>
                                            <td class="col-2">{{ $data->name }}</td>
                                            <td class="col-2">{{ $data->email }}</td>
                                            <td class="">{{ $data->gender }}</td>
                                            <td class="">{{ $data->phone }}</td>
                                            <td class="col-2">{{ $data->address }}</td>
                                            {{-- <td class="col-2">{{ $data->role }}</td> --}}
                                            <td class="col-4">
                                                @if ($data->id == Auth::user()->id)
                                                    <select name="" class="form-control">
                                                        <option value="admin" @if($data->role == 'admin') selected @endif disabled >Admin</option>
                                                        <option value="user" @if($data->role == 'user') selected @endif disabled >User</option>
                                                    </select>
                                                @else
                                                    <select name="" class="form-control rolestatus">
                                                        <option value="admin" @if($data->role == 'admin') selected @endif >Admin</option>
                                                        <option value="user" @if($data->role == 'user') selected @endif >User</option>
                                                    </select>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if ($data->id == Auth::user()->id)
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" disabled >
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    @else
                                                        {{-- <a href="{{ route('account#role',$data->id) }}" class="me-2">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                                <i class="fa-solid fa-user-pen"></i>
                                                            </button>
                                                        </a> --}}
                                                        <a href="{{ route('account#delete',$data->id) }}" >
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="">
                                {{ $datas->links() }}
                            </div>
                        </div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('.rolestatus').change(function(){
            $rolevalue = $(this).val();
            $parentdata = $(this).parents('tbody tr');
            $user_id = $parentdata.find('#user_id').val();
            $.ajax({
                type: 'get',
                url: '/admin/account/role/change',
                dataType: 'json',
                data: {
                    'user_id': $user_id,
                    'role': $rolevalue,
                },
                success: function(response){
                    if(response.status == 'success'){
                        window.location.href = "/admin/account/list";
                    }
                }
            })
        })




    })
</script>

@endsection
