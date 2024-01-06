<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\userlistcontroller;
use App\Http\Controllers\user\ajaxcontroller;
use App\Http\Controllers\user\usercontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// login,register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','LoginPage');
    Route::get('LoginPage',[authcontroller::class,'loginpage'])->name('login#page');
    Route::get('RegisterPage',[authcontroller::class,'registerpage'])->name('register#page');
});

Route::middleware(['auth','verified'])->group(function () {

    // Auth
    Route::get('auth',[authcontroller::class,'auth'])->name('auth');

    // Admin
    Route::middleware(['admin_auth'])->group(function(){
        // Category
        Route::prefix('category')->group(function () {
            Route::get('list/page',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createpage'])->name('category#create');
            Route::post('create',[CategoryController::class,'create'])->name('create#category');
            Route::get('delete/page/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/page/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('update#category');
        });

        // admin account
        Route::prefix('admin')->group(function () {
            // account
            Route::get('account/details',[admincontroller::class,'details'])->name('account#details');
            Route::get('account/edit',[admincontroller::class,'edit'])->name('account#edit');
            Route::post('account/update/{id}',[admincontroller::class,'update'])->name('account#update');
            Route::get('account/list',[admincontroller::class,'list'])->name('account#list');
            Route::get('account/delete/{id}',[admincontroller::class,'delete'])->name('account#delete');
            Route::get('account/role/change',[admincontroller::class,'rolechange'])->name('account#rolechange');
            // Route::get('account/role/{id}',[admincontroller::class,'rolePage'])->name('account#role');
            // Route::post('account/role/change/{id}',[admincontroller::class,'change'])->name('role#change');

            // Password
            Route::get('passsword/changePage',[admincontroller::class,'changePage'])->name('password#changePage');
            Route::post('password/change',[admincontroller::class,'changePassword'])->name('password#change');

        });

        // Product
        Route::prefix('product')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createpage'])->name('product#create');
            Route::post('create',[ProductController::class,'create'])->name('create#product');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update',[ProductController::class,'update'])->name('update#product');
        });

        // Order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'list'])->name('order#list');
            Route::get('status/search',[OrderController::class,'statusSearch'])->name('order#statusSearch');
            Route::get('ajax/status/change',[OrderController::class,'ajaxstatuschange'])->name('order#ajaxstatuschange');
            Route::get('details/{ordercode}',[orderController::class,'orderdetails'])->name('order#listdetails');
        });

        // User List
        Route::prefix('user')->group(function(){
            Route::get('list',[userlistcontroller::class,'list'])->name('admin#userlist');
            Route::get('role/change',[userlistcontroller::class,'rolechange'])->name('admin#userrolechange');
            Route::get('account/ban/{id}',[userlistcontroller::class,'accountban'])->name('admin#accountban');
        });

        // contact list
        Route::prefix('contact')->group(function(){
            Route::get('list',[ContactController::class,'list'])->name('admin#contactlist');
        });

    });



    // User
    Route::middleware(['user_auth'])->group(function(){
        // user
        Route::prefix('user')->group(function(){
            Route::get('home',[usercontroller::class,'home'])->name('user#home');

            // password
            Route::get('passsword/ChangePage',[usercontroller::class,'changePage'])->name('user#passwordchangepage');
            Route::post('password/change',[usercontroller::class,'changePassword'])->name('user#passwordchange');

            // account
            Route::get('account/update',[usercontroller::class,'accountUpdatePage'])->name('user#accountupdatePage');
            Route::post('account/update/{id}',[usercontroller::class,'accountUpdate'])->name('user#accountupdate');

            // pizzadetail
            Route::prefix('pizza')->group(function(){
                Route::get('detail/{id}',[usercontroller::class,'pizzadetail'])->name('pizza#detail');
            });

            // filter
            Route::get('filter/{id}',[usercontroller::class,'filter'])->name('user#filter');

            // cart
            Route::prefix('cart')->group(function(){
                Route::get('list',[CartController::class,'cartlist'])->name('cart#list');
                Route::get('history',[CartController::class,'carthistory'])->name('cart#history');
            });

            // contact
            Route::prefix('contact')->group(function(){
                Route::get('Page',[ContactController::class,'contact'])->name('user#contact');
                Route::post('contactSend',[ContactController::class,'contactsend'])->name('user#contactSend');
            });

            // ajax
            Route::prefix('ajax')->group(function () {
                Route::get('pizza/list',[ajaxcontroller::class,'pizzalist'])->name('ajax#pizzalist');
                Route::get('pizza/card',[ajaxcontroller::class,'pizzacard'])->name('ajax#pizzacard');
                Route::get('pizza/order',[ajaxcontroller::class,'pizzaorder'])->name('ajax#pizzaorder');
                Route::get('cart/cancel',[ajaxcontroller::class,'cartcancel'])->name('ajax#cartcancel');
                Route::get('cart/remove',[ajaxcontroller::class,'cartremove'])->name('ajax#cartremove');
                Route::get('view/count',[ajaxcontroller::class,'viewcount'])->name('ajax#viewcount');
            });
        });
    });
});
