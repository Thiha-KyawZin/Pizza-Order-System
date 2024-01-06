<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // list page
    public function list(){
        $datas = Product::select('products.*','categories.name as category_name')
                    ->when(request('search'),function($searchKey){
                        $searchKey->where('products.name','like','%'.request("search").'%');
                    })
                    ->leftJoin('categories','categories.id','products.category_id')
                    ->orderBy('products.id','desc')->paginate(4);
        $datas->appends(request()->all());
        return view('admin.Product.list',compact('datas'));
    }

    // create page
    public function createpage(){
        $datas = Category::select('id','name')->get();
        return view('admin.Product.create',compact('datas'));
    }

    // create
    public function create(Request $request){
        $this->productvalidation($request,'create');
        $data = $this->productdata($request);

        $image = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/product_image/',$image);
        $data['image'] = $image;

        Product::create($data);
        return redirect()->route('product#list')->with(['createsuccess' => 'Create Success']);
    }

    // delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deletesuccess' => 'Delete Success']);
    }

    // view
    public function view($id){
        $data = Product::select('products.*','categories.name as category_name')
                ->where('.products.id',$id)
                ->leftJoin('categories','categories.id','products.category_id')
                ->first();
        return view('admin.Product.view',compact('data'));
    }

    // edit
    public function edit($id){
        $data = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.Product.edit',compact('data','category'));
    }

    // update
    public function update(Request $request){
        $this->productvalidation($request,'update');
        $data = $this->productdata($request);
        if($request->hasFile('image')){
            $oldImage = Product::where('id',$request->id)->first()->image;
            Storage::delete('public/product_image/'.$oldImage);

            $newImage = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/product_image/',$newImage);
            $data['image'] = $newImage;
        }
        Product::where('id',$request->id)->update($data);
        return redirect()->route('product#list')->with(['updatesuccess' => 'Update Success']);
    }


    // Data
    private function productdata($request){
        return [
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'wating_time' => $request->wating_time
        ];
    }



    // Validation
    // productvalidation
    private function productvalidation($request,$action){
        $validation = [
            'name' => 'required|unique:Products,name,'.$request->id,
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'wating_time' => 'required',
        ];
        $validation['image'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg,webp |file' : 'mimes:png,jpg,jpeg,webp |file';
        Validator::make($request->all(),$validation)->Validate();
    }

}
