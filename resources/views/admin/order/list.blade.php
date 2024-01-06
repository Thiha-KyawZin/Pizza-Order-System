@extends('admin.layouts.master')

@section('title', 'Order List')

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
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <h3 class="mt-2">Total-{{ count($datas) }}</h3>
                        </div>
                        <div class="col-3 offset-2">
                            <form action="{{ route('order#statusSearch') }}" method="get">
                                @csrf
                                <div class="input-group col-10">
                                    <select class="form-select"  name="orderstatus" id="inputGroupSelect04" aria-label="Example select with button addon">
                                        <option value="all">All</option>
                                        <option value="0" @if(request('orderstatus') == '0') selected @endif>Pending</option>
                                        <option value="1" @if(request('orderstatus') == '1') selected @endif>Accept</option>
                                        <option value="2" @if(request('orderstatus') == '2') selected @endif>Reject</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary rounded-end"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-4 offset-1">
                            <form class="form-header" action="{{ route('order#list') }}" method="get">
                                @csrf
                                <div class="input-group ">
                                    <input type="text" name="search" class="form-control rounded-start"
                                        placeholder="Enter Order Code" value="{{ request('search') }}"
                                        aria-describedby="basic-addon2">
                                    <button class="btn btn-primary rounded-end" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    @if (count($datas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>UserName</th>
                                        <th>Order Code</th>
                                        <th>Order Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="statuslist">
                                    @foreach ($datas as $data)
                                        <tr class="tr-shadow" >
                                            <input type="hidden" value="{{ $data->id }}" id="orderid">
                                            <td class="col-1">{{ $data->user_id }}</td>
                                            <td class="col-2">{{ $data->user_name }}</td>
                                            <td class="col-2" id="ordercode">
                                                <a href="{{ route('order#listdetails',$data->order_code) }}" class="text-primary text-decoration-none">{{ $data->order_code }}</a>
                                            </td>
                                            <td class="col-3">{{ $data->created_at->timezone('Asia/Yangon')->format('h:i A | j-F-Y') }}
                                            </td>
                                            <td class="col-1" id="orderprice">{{ number_format($data->total_price) }}</td>
                                            <td class="col-2">
                                                <select name="" class="form-control statuschange">
                                                    <option value="0" @if ($data->status == 0) selected @endif >Pending</option>
                                                    <option value="1" @if ($data->status == 1) selected @endif >Accept</option>
                                                    <option value="2" @if ($data->status == 2) selected @endif >Reject</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center mt-5">
                            <h3 class="text-muted">There is no Order Here!</h3>
                        </div>
                    @endif

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
            $('.statuschange').change(function() {
                $status = $(this).val();
                $parentdata = $(this).parents('tbody tr');
                $orderId = $parentdata.find('#orderprice').val();
                $orderId = $parentdata.find('#orderid').val();
                $orderCode = $parentdata.find('#ordercode').text();
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/status/change',
                    dataType: 'json',
                    data: {
                        'Order_id': $orderId,
                        'status': $status,
                        'order_code': $orderCode,
                    },
                })
            })
        })
    </script>
@endsection
