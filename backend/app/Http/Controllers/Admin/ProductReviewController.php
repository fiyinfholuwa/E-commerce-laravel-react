<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function AllReviews(Request $request){
        $product_code = $request->product_code;
        $product_review = ProductReview::where('product_code', $product_code)->orderBy("id", "desc")->get();
        return $product_review;

    }
}
