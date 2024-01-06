<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // order list
    public function list(){
        $datas = Order::when(request('search'),function($searchKey){
                    $searchKey->where('order_code','like','%'.request('search').'%');
                })
                ->select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('id','desc')
                ->get();
        return view('admin.order.list',compact('datas'));
    }

    // order list detail
    public function orderdetails($ordercode){
        $totalprice = Order::where('order_code',$ordercode)->first();
        $datas = orderlist::select('orderlists.*','products.name as product_name','products.image as product_image','users.name as user_name')
                    ->leftJoin('products','products.id','orderlists.product_id')
                    ->leftJoin('users','users.id','orderlists.user_id')
                    ->where('orderlists.order_code',$ordercode)->get();
        return view('admin.order.detail',compact('datas','totalprice'));
    }



    // ajax status
    public function statusSearch(Request $request){
        $datas = Order::when(request('search'),function($searchKey){
            $searchKey->where('order_code','like','%'.request('search').'%');
        })
        ->select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('id','desc');

        if($request->orderstatus == 'all'){
            $datas = $datas->get();
        }else{
            $datas = $datas->where('orders.status',$request->orderstatus)->get();
        }
        return view('admin.order.list',compact('datas'));

    }

    // ajax status change
    public function ajaxstatuschange(Request $request){
        Order::where('id',$request->Order_id)->where('order_code',$request->order_code)->update(['status' => $request->status]);
    }

}
