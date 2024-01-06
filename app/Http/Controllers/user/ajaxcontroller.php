<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ajaxcontroller extends Controller
{
    // filter
    public function pizzalist(Request $request){
        if($request->status == 'latest'){
            $data = Product::orderBy('id','desc')->get();
        }elseif($request->status == 'name'){
            $data = Product::orderBy('name','asc')->get();
        }elseif($request->status == 'price'){
            $data = Product::orderBy('price','desc')->get();
        }
        return response()->json($data, 200);
    }

    // cart
    public function pizzacard(Request $request){
        $data = $this->updateData($request);
        Cart::create($data);

        $cardData = [
            'message' => 'Add to card Complete',
            'status' => 'success',
        ];
        return response()->json($cardData, 200);
    }

    // order
    public function pizzaorder(Request $request){
        $total = 0;
        foreach($request->all() as $data){
            orderlist::create($data);
            $total += $data['total'];
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $request[0]['order_code'],
            'total_price' => $total+2500,
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // cart cancel
    public function cartcancel(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // cart remove
    public function cartremove(Request $request){
        Cart::where('user_id',Auth::user()->id)
            ->where('id',$request->cart_id)
            ->where('product_id',$request->product_id)
            ->delete();
    }

    // view count
    public function viewcount(Request $request){
        $data = Product::where('id',$request->pizzaId)->first();
        Product::where('id',$request->pizzaId)->update(['view_count' => $data->view_count + 1]);
    }


    // updateData
    private function updateData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'quantity' => $request->ordercount,
        ];
    }

}
