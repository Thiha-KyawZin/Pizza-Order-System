<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartlist(){
        $datas = Cart::select('Carts.*','Products.name as pizza_name','Products.price as pizza_price','Products.image as pizza_image')
                    ->leftJoin('Products','Products.id','Carts.product_id')
                    ->where('Carts.user_id',Auth::user()->id)
                    ->get();
        $totalprice = 0;

        foreach ($datas as $data) {
            $totalprice += $data->pizza_price * $data->quantity;
        }

        return view('user.cart.cart',compact('datas','totalprice'));
    }

    // history
    public function carthistory(){
        $datas = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.cart.history',compact('datas'));
    }
}
