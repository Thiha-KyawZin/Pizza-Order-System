@extends('user.layout.master')

@section('title','History')


@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-10 offset-1 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="pizzatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($datas as $data)
                            <tr>
                                {{-- <input type="hidden" value="{{ $data->user_id }}" id="user_id">
                                <input type="hidden" value="{{ $data->product_id }}" id="product_id"> --}}
                                <td class="align-middle" id="pizzaprice">{{ $data->created_at->timezone('Asia/Yangon')->format('h:i A | j-F-Y') }}</td>
                                <td class="align-middle" id="pizzaprice">{{ $data->order_code }} </td>
                                <td class="align-middle" id="pizzaprice">{{  number_format($data->total_price) }} Kyats</td>
                                <td class="align-middle" id="pizzaprice">
                                    @if ($data->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-hourglass-half me-2"></i>Pending</span>
                                    @elseif ($data->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check me-2"></i>Success</span>
                                    @elseif ($data->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $datas->links() }}
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
            $random = Math.floor(Math.random() * 10000000);

            $('#pizzatable tbody tr').each(function(index,row){
                $datas.push({
                    'user_id' : $(row).find('#user_id').val(),
                    'product_id' : $(row).find('#product_id').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#total').text().replace('Kyats','')),
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
    </script>
@endsection

