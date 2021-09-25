<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::latest()->get();
        return view('admin.categories.categories',compact('categories'));
    }

    public function create(Request $request){
        
        $validated = $request->validate([
            'category_name_en' => 'required',            
            'category_name_ph' => 'required',    
            'category_icon' => 'required'
        ]);

        //dd($request);
        
        //dd($test);
        //dd($request);
        Category::insert([
            'category_name_en' =>$request->category_name_en,
            'category_name_ph' =>$request->category_name_ph,
            'category_slug_en' =>Str::slug($request->category_name_en, '-'),
            'category_slug_ph' =>Str::slug($request->category_name_ph, '-'),
            'category_icon' =>$request->category_icon
            
        ]);
        $toastrMsg=array(
            'message' => 'Category Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);

    }




    public function edit($id){
        $category=Category::findOrFail($id);
        return view('admin.categories.categoryedit',compact('category'));
    }

    public function update(Request $request){
        $data=Category::find($request->id);
        //dd($data);
        //dd(public_path('storage/profile-photos/'.$data->profile_photo_path));
        $data->category_name_en=$request->category_name_en;
        $data->category_name_ph=$request->category_name_ph;                
        $data->category_slug_en=Str::slug($request->category_name_en, '-');                
        $data->category_slug_ph=Str::slug($request->category_name_ph, '-');                
        $data->category_icon=$request->category_icon;        
        $data->save();

        $toastrMsg=array(
            'message' => 'Category Updated! - TEST',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($toastrMsg);
    }

    public function delete($id){        

        Category::findOrFail($id)->delete();

        $toastrMsg=array(
            'message' => 'Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }
}
