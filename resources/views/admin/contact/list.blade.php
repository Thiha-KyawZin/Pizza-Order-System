@extends('admin.layouts.master')

@section('title','Message List')

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
                                <h2 class="title-1">Message List</h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            {{-- <h3 class="mt-2">Total-{{ $datas->total() }}</h3> --}}
                        </div>
                        <div class="col-3 offset-5">
                            <form class="form-header" action="{{ route('admin#contactlist') }}" method="get">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr class="tr-shadow">
                                            <td class="col-2">{{ $data->name }}</td>
                                            <td class="col-2">{{ $data->email }}</td>
                                            <td class="col-5">{{ $data->message }}</td>
                                            <td class="col-3">{{ $data->created_at->timezone('Asia/Yangon')->format('h:i A | j-F-Y') }}
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
                            <h3 class="text-muted">There is no Message Here!</h3>
                        </div>
                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
