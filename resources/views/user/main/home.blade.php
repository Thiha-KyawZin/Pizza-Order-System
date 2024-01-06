@extends('user.layout.master')

@section('title', 'Home')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">

                <!-- Category Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-light pr-3">Filter by
                        Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class="mt-2" for="price-all">Category</label>
                            <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                        </div>
                        <a href="{{ route('user#filter','all') }}" class="text-black">
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                                <label class="" for="color-1">All</label>
                                <img src="{{ asset('storage/logo_image/All_logo.png') }}" style="width: 40px;">
                            </div>
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('user#filter',$category->id) }}" class="text-black">
                                <div class=" d-flex align-items-center justify-content-between mb-3">
                                    <label class="" for="color-1">{{ $category->name }}</label>
                                    <img src="{{ asset('storage/logo_image/' . $category->image) }}" style="width: 40px;">
                                </div>
                            </a>
                        @endforeach
                    </form>
                </div>
                <!-- Category End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('cart#list') }}" class="text-decoration-none">
                                    <button type="button" class="btn btn-outline-dark position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-light">
                                          {{ count($pizzacount) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('cart#history') }}" class="text-decoration-none">
                                    <button type="button" class="btn btn-outline-dark position-relative ms-2">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-light">
                                          {{ count($historycount) }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="latest">Latest</option>
                                        <option value="name">Order by Name</option>
                                        <option value="price">Order by Price</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="data">
                        @if (count($datas) != null)
                            @foreach ($datas as $data)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" style="height: 370px">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100"
                                                src="{{ asset('storage/product_image/' . $data->image) }}" alt="" style="height: 200px">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#detail',$data->id) }}"><i class="fa-solid fa-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-wrap"
                                                href="{{ route('pizza#detail',$data->id) }}">{{ $data->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h5>{{ number_format($data->price) }} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center fs-3 mt-5 ">{{ $category->name }} is not Here!</div>
                        @endif
                    </div>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                if ($eventOption == 'latest') {
                    $.ajax({
                        type: 'get',
                        dataType: 'json',
                        data: {
                            'status': 'latest'
                        },
                        url: '/user/ajax/pizza/list',
                        success: function(sortingData) {
                            $list = '';
                            for ($i = 0; $i < sortingData.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" style="height: 400px">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/product_image/${sortingData[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-wrap" href="">${sortingData[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h5>${sortingData[$i].price}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#data').html($list);
                        }
                    })
                } else if ($eventOption == 'name') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        dataType: 'json',
                        data: {
                            'status': 'name'
                        },
                        success: function(sortingData) {
                            $list = '';
                            for ($i = 0; $i < sortingData.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" style="height: 400px">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/product_image/${sortingData[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-wrap" href="">${sortingData[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h5>${sortingData[$i].price}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#data').html($list);
                        }
                    })
                } else if ($eventOption == 'price') {
                    $.ajax({
                        type: 'get',
                        dataType: 'json',
                        data: {
                            'status': 'price'
                        },
                        url: '/user/ajax/pizza/list',
                        success: function(sortingData) {
                            $list = '';
                            for ($i = 0; $i < sortingData.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" style="height: 400px">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/product_image/${sortingData[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-wrap" href="">${sortingData[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h5>${sortingData[$i].price}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#data').html($list);
                        }
                    })
                }
            })
        });
    </script>

@endsection
