@extends('user.layout.master')

@section('title', 'Pizza Detail')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#home') }}"><i class="fa-solid fa-left-long text-dark fs-3 mb-1"></i></a>
                <div class="">
                    <img class="w-100 h-100" src="{{ asset('storage/product_image/' . $pizzaData->image) }}" alt="Image">
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="pizzaId" value="{{ $pizzaData->id }}">
                    <h3>{{ $pizzaData->name }}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1"><i class="fa-solid fa-eye"></i> {{ $pizzaData->view_count + 1 }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ number_format($pizzaData->price) }} Kyats</h3>
                    <p class="mb-4">{{ $pizzaData->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-outline-warning btn-minus h-100 text-dark">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="ordercount" class="form-control border-0 text-center" value="1" >
                            <div class="input-group-btn">
                                <button class="btn btn-outline-warning btn-plus h-100 text-dark">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-warning px-3" id="addtocartBtn" type="button"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-white pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5 ">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $list)
                        <div class="product-item bg-light" style="height: 350px">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 200px"
                                    src="{{ asset('storage/product_image/' . $list->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart mt-1"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart mt-1"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('pizza#detail', $list->id) }}"><i
                                            class="fa-solid fa-info mt-1"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate text-wrap"
                                    href="">{{ $list->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ number_format($list->price) }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    {{-- <small>(99)</small> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // view
            $.ajax({
                    type : 'get',
                    data : {
                        'pizzaId' : $('#pizzaId').val(),
                    },
                    dataType : 'json',
                    url : '/user/ajax/view/count',
                });


            // cart
            $('#addtocartBtn').click(function(){
                $orderdata = {
                    'userId' : $('#userId').val(),
                    'pizzaId' : $('#pizzaId').val(),
                    'ordercount' : $('#ordercount').val(),
                };
                $.ajax({
                    type : 'get',
                    data : $orderdata,
                    dataType : 'json',
                    url : '/user/ajax/pizza/card',
                    success : function(cardData){
                        if(cardData.status == 'success'){
                            window.location.href = "/user/home";
                        }
                    }

                });
            });
        });
    </script>
@endsection
