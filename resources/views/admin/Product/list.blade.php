@extends('admin.layouts.master')

@section('title', 'Product List')

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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#create') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h3 class="mt-2">Total-{{ $datas->total() }}</h3>
                        </div>
                        <div class="col-3 offset-5">
                            <form class="form-header" action="{{ route('product#list') }}" method="get">
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
                    @if (session('createsuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-4 offset-8 mt-3" role="alert">
                            <i class="fa-solid fa-check"></i> {{ session('createsuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('updatesuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-4 offset-8 mt-3" role="alert">
                            <i class="fa-solid fa-check"></i> {{ session('updatesuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('deletesuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-4 offset-8 mt-3" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('deletesuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (count($datas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr class="tr-shadow">
                                            <td class="col-2"><img src="{{ asset('storage/product_image/'.$data->image) }}" alt=""></td>
                                            <td class="col-2">{{ $data->name }}</td>
                                            <td class="col-2">{{ number_format($data->price) }} Kyats</td>
                                            <td class="col-2">{{ $data->category_name }}</td>
                                            <td class="col-2">{{ $data->view_count }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#view',$data->id) }}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                    </a>
                                                    <a href="{{ route('product#edit',$data->id) }}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete',$data->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>
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
                    @else
                        <div class="text-center mt-5">
                            <h3 class="text-muted">There is no Products Here!</h3>
                        </div>
                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
