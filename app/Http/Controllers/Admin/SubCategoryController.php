<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategories=SubCategory::with('category')->latest()->get();
        // $i = compact('subcategories');
        // dd($i->category->category_name_en);
        $categories=Category::orderBy('category_name_en')->get();
        //dd($subcategories);
        return view('admin.categories.subcategories',compact('subcategories'),compact('categories'));
    }

    public function create(Request $request){
                
        $validated = $request->validate([
            'subcategory_name_en' => 'required',            
            'subcategory_name_ph' => 'required',    
            'category_id' => 'required'
        ]);



        //dd($request);
        
        //dd($test);
        //dd($request);
        SubCategory::insert([
            'subcategory_name_en' =>$request->subcategory_name_en,
            'subcategory_name_ph' =>$request->subcategory_name_ph,
            'subcategory_slug_en' =>Str::slug($request->subcategory_name_en, '-'),
            'subcategory_slug_ph' =>Str::slug($request->subcategory_name_ph, '-'),
            'category_id' =>$request->category_id
            
        ]);
        $toastrMsg=array(
            'message' => 'SubCategory Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);

    }

    public function edit($id){
        $subcategory=SubCategory::findOrFail($id);
        // $i = compact('subcategories');
        // dd($i->category->category_name_en);
        $categories=Category::orderBy('category_name_en')->get();
        return view('admin.categories.subcategoriesedit',compact('subcategory','categories'));
    }

    public function update(Request $request){
        $data=SubCategory::find($request->id);
        //dd($data);
        //dd(public_path('storage/profile-photos/'.$data->profile_photo_path));
        $data->subcategory_name_en=$request->subcategory_name_en;
        $data->subcategory_name_ph=$request->subcategory_name_ph; 
        $data->subcategory_slug_en=Str::slug($request->subcategory_name_en, '-');                
        $data->subcategory_slug_ph=Str::slug($request->subcategory_name_ph, '-');                       
        $data->category_id=$request->category_id;        
        $data->save();

        $toastrMsg=array(
            'message' => 'Category Updated! - TEST',
            'alert-type' => 'success'
        );

        return redirect()->route('category.sub.all')->with($toastrMsg);
    }

    
    public function delete($id){
        SubCategory::findOrFail($id)->delete();

        $toastrMsg=array(
            'message' => 'Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    /*************************************************************************************** */
    /*************************************************************************************** */
    /*************************************************************************************** */

    /*************************************************************************************** */
    /*************************************************************************************** */

    public function subIndex(){
        $subsubcategories=SubSubCategory::with(['category','subcategory'])->latest()->get();
        // $i = compact('subcategories');
        // dd($i->category->category_name_en);
        $categories=Category::orderBy('category_name_en')->get();
        $subcategories=SubCategory::orderBy('subcategory_name_en')->get();
        //dd($subsubcategories);
        return view('admin.categories.sub_subcategories',compact('subsubcategories','categories','subcategories'));
    }

    public function subCreate(Request $request){
                        
        $validated = $request->validate([
            'subsubcategory_name_en' => 'required',            
            'subsubcategory_name_ph' => 'required',    
            'category_id' => 'required',
            'subcategory_id' => 'required'

        ]);



        //dd($request);
        
        //dd($test);
        //dd($request);
        SubSubCategory::insert([
            'subsubcategory_name_en' =>$request->subsubcategory_name_en,
            'subsubcategory_name_ph' =>$request->subsubcategory_name_ph,
            'subsubcategory_slug_en' =>Str::slug($request->subsubcategory_name_en, '-'),
            'subsubcategory_slug_ph' =>Str::slug($request->subsubcategory_name_ph, '-'),
            'category_id' =>$request->category_id,
            'subcategory_id' =>$request->subcategory_id
            
        ]);
        $toastrMsg=array(
            'message' => 'Sub->SubCategory Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);

    }

    public function subEdit($id){
        $subsubcategory = SubSubCategory::findOrFail($id);
        $categories=Category::orderBy('category_name_en')->get();
        $subcategories=SubCategory::where('category_id',$subsubcategory->category_id)->orderBy('subcategory_name_en')->get();
        return view('admin.categories.sub_subcategory_edit',compact('subsubcategory','categories','subcategories'));
    }

    public function subUpdate(Request $request){
        $validated = $request->validate([
            'subsubcategory_name_en' => 'required',            
            'subsubcategory_name_ph' => 'required',    
            'category_id' => 'required',
            'subcategory_id' => 'required'

        ]);


        $data=SubSubCategory::find($request->id);
        //dd($data);
        //dd(public_path('storage/profile-photos/'.$data->profile_photo_path));
        $data->subsubcategory_name_en=$request->subsubcategory_name_en;
        $data->subsubcategory_name_ph=$request->subsubcategory_name_ph; 
        $data->subsubcategory_slug_en=Str::slug($request->subsubcategory_name_en, '-');                
        $data->subsubcategory_slug_ph=Str::slug($request->subsubcategory_name_ph, '-');                       
        $data->category_id=$request->category_id;        
        $data->subcategory_id=$request->subcategory_id;       
        $data->save();

        $toastrMsg=array(
            'message' => 'Sub->SubCategory Updated! - TEST',
            'alert-type' => 'success'
        );

        return redirect()->route('category.sub.sub.all')->with($toastrMsg);
    }

    public function subDelete($id){
        SubSubCategory::findOrFail($id)->delete();

        $toastrMsg=array(
            'message' => 'Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    /*********************************************************** */

    public function getSubCategoryAjax($id){
        $data=SubCategory::with('subsubcategory')->where('category_id',$id)->orderBy('subcategory_name_en')->get();

        // $data=compact('data'); $str="";
        // foreach($data as $item){
        //     $str=$str." ".$item[0]->category_id." ".$item[0]->subsubcategory->subsubcategory_name_en;
            
        // }

        //dd($data);

        //return $data->id." ".$data->subsubcategory->subsubcategory_name_en;
        return json_encode($data);        
        
    }

    public function getSubSubCategoryAjax($id){
        $data=SubSubCategory::where('subcategory_id',$id)->orderBy('subsubcategory_name_en')->get();

        return json_encode($data);        

    }
}
