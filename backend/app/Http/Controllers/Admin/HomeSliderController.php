<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class HomeSliderController extends Controller
{
    public function AllSiders(){
        $result = Slider::all();
        return $result;
    }

    public function AddSlider(){

        return view('backend.slider.slider_add');

   }// End Mehtod 

   public function GetAllSlider(){
    $slider = Slider::latest()->get();
    return view('backend.slider.slider_view',compact('slider'));
} // End Mehtod 


   public function StoreSlider(Request $request){

        $request->validate([
           'slider_image' => 'required',
       ],[
           'slider_image.required' => 'Upload Slider Image'

       ]);

       $image = $request->file('slider_image');
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    //    Image::make($image)->resize(1024,379)->save('upload/slider/'.$name_gen);
       $image->move(public_path('upload/slider'),$name_gen);
       $host= request()->getSchemeAndHttpHost();
       $save_url = $host.'/upload/slider/'.$name_gen;
    //    $save_url = 'http://127.0.0.1:8000/upload/slider/'.$name_gen;

       Slider::insert([          
           'slider_image' => $save_url,
       ]);

       $notification = array(
           'message' => 'Slider Inserted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('all.slider')->with($notification);

   }// End Mehtod 


   public function EditSlider($id){
       $slider = Slider::findOrFail($id);
       return view('backend.slider.slider_edit',compact('slider'));

   } // End Mehtod 


   public function UpdateSlider(Request $request){

       $slider_id = $request->id;

       $image = $request->file('slider_image');
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       $image->move(public_path('upload/slider'),$name_gen);
       $host= request()->getSchemeAndHttpHost();
       $save_url = $host.'/upload/slider/'.$name_gen;
       Slider::findOrFail($slider_id)->update([          
           'slider_image' => $save_url,
       ]);

       $notification = array(
           'message' => 'Slider Updated Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('all.slider')->with($notification);

   } // End Mehtod 


   public function DeleteSlider($id){

       Slider::findOrFail($id)->delete();

       $notification = array(
           'message' => 'Slider Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route("all.slider")->with($notification);

   } // End Mehtod 
}
