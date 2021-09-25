<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        return view('admin.sliders.sliders',compact('sliders'));
        
    }

    public function status($id){
        $slider = Slider::findOrFail($id);
        if ($slider->status==1){
            $slider->status=0;
        }
        else{
            $slider->status=1;
        }
        $slider->save();
        $toastrMsg=array(
            'message' => 'Done!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    public function store(Request $request){
        
        $validated = $request->validate([            
            'slider_image' => 'required'
        ]);

        $image = $request->file('slider_image') ;
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(870,370)->save('uploads/sliders/'.$image_name);
        
        Slider::create([
            'slider_title' =>$request->slider_title,
            'slider_description' =>$request->slider_description,            
            'status'=>1,
            'slider_image' =>'uploads/sliders/'.$image_name,
            
        ]);
        $toastrMsg=array(
            'message' => 'Slider Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);

    }

    public function edit($id){
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.slider_edit',compact('slider'));
    }

    public function update(Request $request){

        $slider = Slider::findOrFail($request->id);
        $image_path=$request->old_image;
        if($request->file('slider_image')){
            @unlink(public_path($slider->slider_image));
            $image = $request->file('slider_image') ;
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image_path='uploads/sliders/'.$image_name;
            Image::make($image)->resize(870,370)->save($image_path);
            $slider->slider_image=$image_path;
        }


        $slider->slider_title=$request->slider_title;
        $slider->slider_description=$request->slider_description;
        $slider->save();
       
        $toastrMsg=array(
            'message' => 'Slider Updated!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    public function delete($id){
        
        $slider=Slider::findOrFail($id);
        @unlink(public_path($slider->slider_image));
        $slider->delete();
        $toastrMsg=array(
            'message' => 'Slider Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }
}
