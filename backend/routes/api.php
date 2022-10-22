<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;



 // Login Routes 
 Route::post('/login',[AuthController::class, 'Login']);

 // Register Routes 
Route::post('/register',[AuthController::class, 'Register']);



 // Current User Route 
Route::get('/user',[UserController::class, 'currentUser'])->middleware('auth:api');


 /////////////// End User Login API Start ////////////////////////


Route::get("/get-visitors", [VisitorController::class, 'GetAllVisitors']);

Route::post("/contact-us", [ContactController::class, 'PostMessage']);

Route::get("/all-category", [CategoryController::class, 'AllCategory']);

Route::get("/product-list-by-remark/{remark}", [ProductController::class, 'ProductListByRemark']);

Route::get("/product-list-by-category/{category}", [ProductController::class, 'ProductListByCategory']);

Route::get("/search/{key}", [ProductController::class, 'ProductBysearch']);

Route::get("/product-list-by-subcategory/{category}/{subcategory}", [ProductController::class, 'ProductListBySubCategory']);

Route::get("/similar/{subcategory}", [ProductController::class, 'SimilarProduct']);

Route::get("/all-slider", [HomeSliderController::class, 'AllSiders']);

Route::get("/product-details/{id}", [ProductDetailController::class, 'ProductDetails']);

Route::get("/all-notifications", [NotificationController::class, 'AllNotification']);

Route::get("/all-reviews/{product_code}", [ProductReviewController::class, 'AllReviews']);

Route::post("/add-cart", [ProductCartController::class, 'AddToCart']);

Route::get('/cart-count/{product_code}',[ProductCartController::class, 'countCart']);

Route::get('/cart-list/{email}',[ProductCartController::class, 'CartList']);

Route::get('/remove-list/{id}', [ProductCartController::class, 'RemoveCart']);
Route::get('/cartitemplus/{id}/{quantity}/{price}', [ProductCartController::class, 'AddItemToCart']);
Route::get('/cartitemminus/{id}/{quantity}/{price}', [ProductCartController::class, 'MinusItemToCart']);

Route::post('/cart-order', [ProductCartController::class, 'CartOrder']);

Route::get('orderlistbyuser/{email}',[ProductCartController::class, 'CartOrderList'] );