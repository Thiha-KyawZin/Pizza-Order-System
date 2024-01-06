@extends('user.layout.master')

@section('title','Cart')


@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="pizzatable">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 300px">Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($datas as $data)
                            <tr>
                                <input type="hidden" value="{{ $data->user_id }}" id="user_id">
                                <input type="hidden" value="{{ $data->id }}" id="cart_id">
                                <input type="hidden" value="{{ $data->product_id }}" id="product_id">
                                <td class="align-middle text-start" ><img src="{{ asset('storage/product_image/'.$data->pizza_image) }}" alt="" style="width: 90px; height: 70px;" class="me-2">{{ $data->pizza_name }}</td>
                                <td class="align-middle" id="pizzaprice">{{ number_format($data->pizza_price) }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-outline-warning btn-minus text-dark">
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center" id="qty" value="{{ $data->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-outline-warning btn-plus text-dark">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ number_format($data->pizza_price * $data->quantity)  }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-light pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">{{ number_format($totalprice) }}Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">2,500 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ number_format($totalprice + 2500) }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold mt-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold mt-3 py-3" id="cancelBtn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('script')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function(){
            $datas = [];
            $random = Math.floor(Math.random() * 1000000000);

            $('#pizzatable tbody tr').each(function(index,row){
                $datas.push({
                    'user_id' : $(row).find('#user_id').val(),
                    'product_id' : $(row).find('#product_id').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#total').text().replace('Kyats','').replace(',','')),
                    'order_code' : 'POS'+$random,
                });

            });
            $.ajax({
                type: 'get',
                url: '/user/ajax/pizza/order',
                dataType: 'json',
                data: Object.assign({},$datas),
                success: function(response){
                    if(response.status == 'success'){
                        window.location.href = "/user/home";
                    }
                }

            });
        })

        // Cancel Btn
        $('#cancelBtn').click(function(){
            $('#pizzatable tbody tr').remove();
            $('#subtotal').text('0 Kyats');
            $('#finalPrice').text('2500 Kyats');
            $.ajax({
                type: 'get',
                url: '/user/ajax/cart/cancel',
                dataType: 'json',
            });
        })

        // Remove
        $('.btnRemove').click(function(){
            $(this).parents('tr').remove();
            $cart_id = $(this).parents('tr').find('#cart_id').val();
            $product_id = $(this).parents('tr').find('#product_id').val();
            $totalPrice = 0;
            $('#pizzatable tbody tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace('Kyats','').replace(',',''));
            });
            $('#subtotal').text(`${$totalPrice.toLocaleString("en-US")} Kyats`);
            $('#finalPrice').text(`${($totalPrice + 2500).toLocaleString("en-US")} Kyats`);
            $.ajax({
                type: 'get',
                url: '/user/ajax/cart/remove',
                dataType: 'json',
                data: {
                    'cart_id' : $cart_id,
                    'product_id' : $product_id,
                },
            });

        })

    </script>
@endsection

