<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\apicontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get
Route::get('product/list',[apicontroller::class,'productlist']);
Route::get('category/list',[apicontroller::class,'categorytlist']);
Route::get('contact/list',[apicontroller::class,'contactlist']);

// post
Route::post('create/contact',[apicontroller::class,'createContact']);

// delete
Route::get('delete/contact/{id}',[apicontroller::class,'getdeletecontact']);
Route::post('delete/contact',[apicontroller::class,'postdeletecontact']);

// detail
Route::get('contact/detail/{id}',[apicontroller::class,'getcontactdetail']);
Route::post('contact/detail',[apicontroller::class,'postcontactdetail']);

// update
Route::post('contact/update',[apicontroller::class,'contactupdate']);
