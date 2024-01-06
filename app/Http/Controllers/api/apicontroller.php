<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class apicontroller extends Controller
{
    // product list
    public function productlist(){
        $product_list = Product::get();
        return response()->json($product_list, 200);
    }

    // category list
    public function categorytlist(){
        $category_list = Category::orderBy('id','desc')->get();
        return response()->json($category_list, 200);
    }

    // contact list
    public function contactlist(){
        $contact_list = Contact::orderBy('id','desc')->get();
        return response()->json($contact_list, 200);
    }

    // create contact
    public function createContact(Request $request){
        $contact = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Contact::create($contact);
        $data = Contact::orderBy('id','desc')->get();
        return response()->json($data, 200);
    }

    // delete
    // get
    public function getdeletecontact($id){
        $data = Contact::where('id',$id)->first();
        if(isset($data)){
            Contact::where('id',$id)->delete();
            return response()->json(['message' => 'Delete Success','data' => $data], 200);
        }
        return response()->json(['message' => 'Delete Fail'], 200);
    }

    // post
    public function postdeletecontact(Request $request){
        $data = Contact::where('id',$request->id)->first();
        if(isset($data)){
            Contact::where('id',$request->id)->delete();
            return response()->json(['message' => 'Delete Success','data' => $data], 200);
        }
        return response()->json(['message' => 'Delete Fail'], 500);
    }

    // detail
    // get
    public function getcontactdetail($id){
        $data = Contact::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['message' => 'Search Success','data' => $data], 200);
        }
        return response()->json(['message' => 'Search Fail'], 500);
    }

    // post
    public function postcontactdetail(Request $request){
        $data = Contact::where('id',$request->id)->first();
        if(isset($data)){
            return response()->json(['message' => 'Search Success','data' => $data], 200);
        }
        return response()->json(['message' => 'Delete Fail'], 500);
    }

    // update
    public function contactupdate(Request $request){
        $data = Contact::where('id',$request->id)->first();
        if(isset($data)){
            $update = [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'updated_at' => Carbon::now(),
            ];
            Contact::where('id',$request->id)->update($update);
            $updatedata = Contact::where('id',$request->id)->first();
            return response()->json(['message' => 'Update Success','data' => $updatedata], 200);
        }
        return response()->json(['message' => 'Update Fail'], 500);
    }




}
