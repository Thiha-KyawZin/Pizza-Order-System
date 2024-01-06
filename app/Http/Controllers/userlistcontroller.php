<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;

class userlistcontroller extends Controller
{
    // user list
    public function list(){
        $datas = User::where('role','user')->paginate('4');
        return view('admin.user.list',compact('datas'));
    }

    // role change
    public function rolechange(Request $request){
        User::where('id',$request->user_id)->update(['role' => $request->role]);
    }

    // account ban
    public function accountban($id){
        $image = User::where('id',$id)->first()->image;
        Storage::delete('public/profile_image/'.$image);
        User::where('id',$id)->delete();
        return back()->with(['deletesuccess' => 'Account Ban Success']);
    }
}
