<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // listPage
    public function list(){
        $datas = Category::when(request('search'),function($searchKey){
                    $searchKey->where('name','like','%'.request("search").'%');
                })
                ->orderBy('id','desc')
                ->paginate(5);
        $datas->appends(request()->all());
        return view('admin.category.list',compact('datas'));
    }

    // categoryPage
    public function createpage(){
        return view('admin.category.create');
    }

    // create category
    public function create(Request $request){
        $this->categoryValidation($request,'create');
        $data = $this->categoryToarray($request);

        $image = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/logo_image/',$image);
        $data['image'] = $image;

        Category::create($data);
        return redirect()->route('category#list')->with(['createsuccess'=>'Create Success']);
    }

    // delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deletesuccess'=>'Delete Success']);
    }

    // editPage
    public function edit($id){
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    // update category
    public function update(Request $request){
        $this->categoryValidation($request,'update');
        $data = $this->categoryToarray($request);

        if($request->hasFile('image')){
            $oldImage = Product::where('id',$request->id)->first()->image;
            Storage::delete('public/product_image/'.$oldImage);

            $newImage = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/product_image/',$newImage);
            $data['image'] = $newImage;
        }

        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updatesuccess' => 'Update Success']);
    }




    // Validation
    private function categoryValidation($request,$action){
        // Validator::make($request->all(),[
        //     'category_name' => 'required|unique:categories,name,'.$request->categoryId,
        // ])->Validate();
        $validtion = [
            'category_name' => 'required|unique:categories,name,'.$request->categoryId,
        ];
        $validtion['image'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg,webp |file' : 'mimes:png,jpg,jpeg,webp |file';
        Validator::make($request->all(),$validtion)->Validate();
    }

    // Change Array
    private function categoryToarray($request){
        return [
            'name' => $request->category_name
        ];
    }
}
