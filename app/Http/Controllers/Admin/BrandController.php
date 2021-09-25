<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index(){
        //return 0;        
        $brands = Brand::latest()->get();
        //dd(compact('brands'));
        return view('admin.brands.brands',compact('brands'));
    }

    public function create(Request $request){

        $validated = $request->validate([
            'brand_name_en' => 'required',            
            'brand_name_ph' => 'required',    
            'brand_image' => 'required'
        ]);

        

        $image = $request->file('brand_image') ;
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        //$test=Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
        Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
        //dd($test);
        //dd($request);
        Brand::insert([
            'brand_name_en' =>$request->brand_name_en,
            'brand_name_ph' =>$request->brand_name_ph,
            'brand_slug_en' =>Str::slug($request->brand_name_en, '-'),
            'brand_slug_ph' =>Str::slug($request->brand_name_ph, '-'),
            'brand_image' =>'uploads/brands/'.$image_name,
            
        ]);
        $toastrMsg=array(
            'message' => 'Brand Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);

    }

    public function edit($id){
        
        $brand=Brand::findOrFail($id);
        //dd($data);
        return view('admin.brands.brandedit',compact('brand'));
    }

    public function update(Request $request){

        $data=Brand::find($request->id);
        //dd(public_path('storage/profile-photos/'.$data->profile_photo_path));
        $data->brand_name_en=$request->brand_name_en;
        $data->brand_name_ph=$request->brand_name_ph;
        if($request->file('brand_image')){
            $file=$request->file('brand_image');
            //dd(public_path($data->brand_image));
            @unlink(public_path($data->brand_image));
            $image = $request->file('brand_image') ;
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //$test=Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
            Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
            $data['brand_image']='uploads/brands/'.$image_name;  
        }
        $data->save();

        $toastrMsg=array(
            'message' => 'Brand Updated! - TEST',
            'alert-type' => 'success'
        );

        return redirect()->route('brand.all')->with($toastrMsg);
    }

    public function delete($id){
        $brand=Brand::findOrFail($id);
        @unlink(public_path($brand->brand_image));

        Brand::findOrFail($id)->delete();

        $toastrMsg=array(
            'message' => 'Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
        
    }

}
