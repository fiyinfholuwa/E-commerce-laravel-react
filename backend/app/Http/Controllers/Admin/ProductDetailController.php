<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\Product;

class ProductDetailController extends Controller
{
    public function ProductDetails(Request $request){
        $id = $request->id;
        $product_details = ProductDetails::where("product_id", $id)->get();

        $product = Product::where("id", $id)->get();
        $item= [
            "ProductList" => $product,
            "ProductDetails" => $product_details
        ];
        return $item;

    }
}
