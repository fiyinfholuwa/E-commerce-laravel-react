<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Category;
use App\Models\SubCategory;
class ProductController extends Controller
{
    public function ProductListByRemark(Request $request){
        $remark = $request->remark;
        $productList = Product::where("remark", $remark)->get();
        return $productList;
    }

    public function ProductListByCategory(Request $request){
        $category = $request->category;
        $productList = Product::where("category", $category)->get();
        return $productList;
    }

    public function ProductListBySubCategory(Request $request){
        $category = $request->category;
        $subcategory = $request-> subcategory;
        $productList = Product::where("category", $category)->where("subcategory", $subcategory)->get();
        return $productList;
    }

    public function ProductBySearch(Request $request){
        $key = $request->key;
        $product_search = Product::where('title', 'LIKE', "%{$key}%")->get();
        return $product_search;
    }

    public function SimilarProduct(Request $request){
        $subcategory = $request->subcategory;
        $product_similar = Product::where('subcategory', $subcategory)->orderBy('id', 'desc')->limit(6)->get();
        return $product_similar;
    }


    public function GetAllProduct(){

        $products = Product::latest()->paginate(10);
        return view('backend.product.product_all',compact('products'));

    } // End Method 


    public function AddProduct(){

        $category = Category::orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::orderBy('subcategory_name','ASC')->get();
        return view('backend.product.product_add',compact('category','subcategory'));

    } // End Method 


    public function StoreProduct(Request $request){

         $request->validate([
            'product_code' => 'required',
        ],[
            'product_code.required' => 'Input Product Code'

        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('upload/product'),$name_gen);
        $host= request()->getSchemeAndHttpHost();
        $save_url = $host.'/upload/product/'.$name_gen;


        $product_id = Product::insertGetId([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url, 

        ]);

        /////// Insert Into Product Details Table ////// 

    $image1 = $request->file('image_one');
    $name_gen1 = hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
    $image1->move(public_path('upload/productdetails'),$name_gen1);
    $host1= request()->getSchemeAndHttpHost();
    $save_url1 = $host1.'/upload/productdetails/'.$name_gen1;


    $image2 = $request->file('image_two');
    $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
    $image2->move(public_path('upload/productdetails'),$name_gen2);
    $host2= request()->getSchemeAndHttpHost();
    $save_url2 = $host2.'/upload/productdetails/'.$name_gen2;


     $image3 = $request->file('image_three');
    $name_gen3 = hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
    $image3->move(public_path('upload/productdetails'),$name_gen3);
    $host3= request()->getSchemeAndHttpHost();
    $save_url3 = $host3.'/upload/productdetails/'.$name_gen3;



     $image4 = $request->file('image_four');
    $name_gen4 = hexdec(uniqid()).'.'.$image4->getClientOriginalExtension();
    $image4->move(public_path('upload/productdetails'),$name_gen4);
    $host4= request()->getSchemeAndHttpHost();
    $save_url4 = $host4.'/upload/productdetails/'.$name_gen4;

        ProductDetails::insert([
            'product_id' => $product_id,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,

        ]);


        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);


    } // End Method 



    public function EditProduct($id){

        $category = Category::orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::orderBy('subcategory_name','ASC')->get();
        $product = Product::findOrFail($id);
        $details = ProductDetails::where('product_id',$id)->get();
        return view('backend.product.product_edit',compact('category','subcategory','product','details'));

    } // End Method 

    public function DeleteProduct($id){

        Product::findOrFail($id)->delete();
 
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
 
        return redirect()->route("all.product")->with($notification);
 
    } // End Mehtod 

}

