<?php

namespace App\Http\Controllers\user;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class usercontroller extends Controller
{
    public function home(){
        $datas = Product::orderBy('created_at','desc')->get();
        $categories = Category::orderBy('name','asc')->get();
        $pizzacount = Cart::where('user_id',Auth::user()->id)->get();
        $historycount = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('datas','categories','pizzacount','historycount'));
    }

    // password Change Page
    public function changePage(){
        return view('user.account.Passwordchange');
    }

    // change password
    public function changePassword(Request $request){
        $this->passwordValidation($request);
        $dbpassword = User::select('password')->where('id',Auth::user()->id)->first();
        $data = $dbpassword->password;
        if(Hash::check($request->old_password, $data)){
            User::where('id',Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
            return back()->with(['changesuccess' => 'Password Changed']);
        }return back()->with(['changefail' => 'The Old Password not Match.Try Again!']);
    }

    // account Updata Page
    public function accountUpdatePage(){
        return view('user.account.accountUpdate');
    }

    // update account
    public function accountUpdate($id,Request $request){
        $this->updateValidation($request);
        $data = $this->updateData($request);
        if($request->hasFile('image')){
            $oldimage = User::where('id',$id)->first()->image;
            if($oldimage != null){
                Storage::delete('public/profile_image/'.$oldimage);
            }
            $newimage = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/profile_image/',$newimage);
            $data['image'] = $newimage;
        }
        User::where('id',$id)->update($data);
        return back()->with(['success' => 'Update Success']);
    }

    // filter data
    public function filter($id){
        if ($id == 'all') {
            $datas = Product::orderBy('created_at','desc')->get();
            $categories = Category::orderBy('name','asc')->get();
            $pizzacount = Cart::where('user_id',Auth::user()->id)->get();
            $historycount = Order::where('user_id',Auth::user()->id)->get();
            return view('user.main.home',compact('datas','categories','pizzacount','historycount'));
        }else
            $datas = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
            $categories = Category::orderBy('name','asc')->get();
            $pizzacount = Cart::where('user_id',Auth::user()->id)->get();
            $historycount = Order::where('user_id',Auth::user()->id)->get();
            return view('user.main.home',compact('datas','categories','pizzacount','historycount'));
    }

    // pizza detail
    public function pizzadetail($id){
        $pizzaData = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.pizzadetail',compact('pizzaData','pizzaList'));
    }




    // update Data
    private function updateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'updated_at' => Carbon::now()
        ];
    }


    // validation

    // update validation
    private function updateValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg |file',
        ])->Validate();
    }

    // password validation
    private function passwordValidation($request){
        Validator::make($request->all(),[
            'old_password' => 'required|min:5|',
            'new_password' => 'required|min:5|',
            'confirm_password' => 'required|min:5|same:new_password'
        ])->Validate();
    }

}
