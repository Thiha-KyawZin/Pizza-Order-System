<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // user contact page
    public function contact(){
        return view('user.contact.contact');
    }

    // contact send
    public function contactsend(Request $request){
        $this->createValidation($request);
        $data = $this->Data($request);
        Contact::create($data);
        return back()->with(['success' => 'Message Send Success']);
    }

    // admin contact list
    public function list(){
        $datas = Contact::when(request('search'),function($searchKey){
                    $searchKey->where('name','like','%'.request("search").'%');
                    })->orderBy('created_at','desc')->paginate('5');
        return view('admin.contact.list',compact('datas'));
    }


     // Data
     private function Data($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }


    // validation

    // create validation
    private function createValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ])->Validate();
    }
}
