@extends('admin.layouts.master')

@section('title', 'Order details')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <a href="{{ route('order#list') }}" class="text-decoration-none"><i class="fa-solid fa-left-long"></i> Back</a>
                    <div class="row mt-2 ms-1">
                        <div class="card col-6">
                            <div class="card-body">
                                <h3>Order Detail</h3>
                                <span class="text-warning">( Include Delivery Charges )</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-4"><i class="fa-solid fa-user me-2"></i>Name</div>
                                    <div class="offset-1 col">{{ ucwords($datas[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="offset-1 col">{{ $datas[0]->order_code }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                    <div class="offset-1 col">{{ $datas[0]->created_at->timezone('Asia/Yangon')->format('h:i A | j-F-Y') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                    <div class="offset-1 col">{{ number_format($totalprice->total_price) }} Kyats</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($datas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="statuslist">
                                    @foreach ($datas as $data)
                                        <tr class="tr-shadow" >
                                            <td class="align-middle col-2">{{ $data->id }}</td>
                                            <td class="col-3"><img src="{{ asset('storage/product_image/'.$data->product_image) }}" alt=""></td>
                                            <td class="col-3">{{ $data->product_name }}</td>
                                            <td class="col-2">{{ $data->qty }}</td>
                                            <td class="col-2" id="orderprice">{{ number_format($data->total) }}</td>
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
