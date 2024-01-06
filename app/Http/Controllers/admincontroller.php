<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class admincontroller extends Controller
{
    // account details
    public function details(){
        return view('admin.Admin_info.account_details');
    }

    // account edit
    public function edit(){
        return view('admin.Admin_info.account_edit');
    }

    // account update
    public function update($id,Request $request){
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
        return redirect()->route('account#details')->with(['success' => 'Update Success']);
    }

    // account list
    public function list(){
        $datas = User::when(request('search'),function($searchkey){
                    $searchkey->orWhere('name','like','%'.request('search').'%')
                              ->orWhere('email','like','%'.request('search').'%')
                              ->orWhere('phone','like','%'.request('search').'%')
                              ->orWhere('address','like','%'.request('search').'%');
                })
                ->where('role','admin')
                ->paginate(3);
        $datas->appends(request()->all());
        return view('admin.Admin_info.account_list',compact('datas'));
    }

    // account delete
    public function delete($id){
        $image = User::where('id',$id)->first()->image;
        Storage::delete('public/profile_image/'.$image);
        User::where('id',$id)->delete();
        return back()->with(['delete' => 'Admin Account Delete']);
    }

    // role change
    public function rolechange(Request $request){
        User::where('id',$request->user_id)->update(['role' => $request->role]);
        return response()->json(['status' => 'success'], 200);
    }

    // password Change Page
    public function changePage(){
        return view('admin.Admin_info.Passwordchange');
    }

    // password Change
    public function changePassword(Request $request){
        $this->passwordValidation($request);
        $dbpassword = User::select('password')->where('id',Auth::user()->id)->first();
        $data = $dbpassword->password;
        if(Hash::check($request->old_password, $data)){
            User::where('id',Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
            return back()->with(['changesuccess' => 'Password Changed']);
        }return back()->with(['changefail' => 'The Old Password not Match.Try Again!']);
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
