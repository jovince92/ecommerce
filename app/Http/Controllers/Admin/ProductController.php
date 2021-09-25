<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        //dd($products);
        return view('admin.products.products',compact('products'));
    }

    public function create(){
        $categories= Category::latest()->get();        
        $brands= Brand::orderBy('brand_name_en')->get();
        return view('admin.products.products_add',compact('categories','brands'));
    }

    public function store(Request $request){
        //dd(public_path('uploads/products/'.$request->product_code));

        if(FIle::exists(public_path('/uploads/products/'.$request->product_code))){
            File::deleteDirectory(public_path('/uploads/products/'.$request->product_code));
        }

        FIle::makeDirectory (public_path('/uploads/products/'.$request->product_code,0777,true));

        FIle::makeDirectory (public_path('/uploads/products/'.$request->product_code.'/images',0777,true));
        FIle::makeDirectory (public_path('/uploads/products/'.$request->product_code.'/thumbnail',0777,true));
        
        $image = $request->file('product_thumbnail') ;
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        

        //$test=Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
        $image_path='uploads/products/'.$request->product_code.'/thumbnail/'.$image_name;
        Image::make($image)->resize(917,1000)->save($image_path);
        //dd($test);
        //dd($request);

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,	
            'category_id' => $request->category_id,	
            'subcategory_id' => $request->subcategory_id,	
            'subsubcategory_id' => $request->subsubcategory_id,	
            'product_name_en' => $request->product_name_en,	
            'product_name_ph' => $request->product_name_ph,	
            'product_slug_en' => Str::slug($request->product_name_en, '-'),  	
            'product_slug_ph' => Str::slug($request->product_name_ph, '-'),  	
            'product_code' => $request->product_code,	
            'product_qty' => $request->product_qty,	
            'product_tags_en' => $request->product_tags_en,	
            'product_tags_ph' => $request->product_tags_ph,	
            'product_size_en' => $request->product_size_en,	
            'product_size_ph' => $request->product_size_ph,	
            'product_color_en' => $request->product_color_en,	
            'product_color_ph' => $request->product_color_ph,	
            'product_prize' => $request->product_price,	
            'product_discount' => $request->product_discount,	
            'product_descp_short_en' => $request->product_descp_short_en,	
            'product_descp_short_ph' => $request->product_descp_short_ph,	
            'product_descp_long_en' => $request->product_descp_long_en,	
            'product_descp_long_ph' => $request->product_descp_long_ph,	            
            'ishot_deals' => $request->ishot_deals,
            'isfeatured' => $request->isfeatured,
            'isspecialoffer' => $request->isspecialoffer,
            'isspecialdeals' => $request->isspecialdeals,
            'product_status'=>1,
            'product_thumbnail' => $image_path,	
            'created_at'=>  Carbon::now()
        ]);

        $multi_images = $request->file('multi_img') ;

        

        foreach($multi_images as $multi_image){
            $multi_image_name = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
            
            $multi_image_path='uploads/products/'.$request->product_code.'/images/'.$multi_image_name;
            Image::make($multi_image)->resize(917,1000)->save($multi_image_path);

            MultiImg::insert([
                'product_id' => $product_id,
                'image_name' => $multi_image_path,
                'created_at'=>  Carbon::now()
            ]);
        }        
        
        $toastrMsg=array(
            'message' => 'Product Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
        
        
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        $multi_images = MultiImg::where('product_id',$product->id)->get();
        
        //dd($categories[0]->subcategory);
        $brands = Brand::orderBy('brand_name_en')->get();
        $subcategories = SubCategory::where('category_id',$product->category_id)->get();
        $subsubcategories = SubSubCategory::where('subcategory_id',$product->subcategory_id)->get();
        
        //dd($product);
        return view('admin.products.products_edit',compact('product','categories','brands','subcategories','subsubcategories','multi_images'));


    }

    public function update(Request $request){
        
        $product_id = $request->id;
        $data=Product::findOrFail($product_id);
        $image_path="";
        if($request->file('product_thumbnail')){
            $image = $request->file('product_thumbnail') ;
            
            @unlink(public_path($data->product_thumbnail));
            
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            $image_path='uploads/products/'.$request->product_code.'/thumbnail/'.$image_name;
            Image::make($image)->resize(917,1000)->save($image_path);
            
        }
        else{
            $image_path=$data->product_thumbnail;
        }
        
        
        $data->update([
            'brand_id' => $request->brand_id,	
            'category_id' => $request->category_id,	
            'subcategory_id' => $request->subcategory_id,	
            'subsubcategory_id' => $request->subsubcategory_id,	
            'product_name_en' => $request->product_name_en,	
            'product_name_ph' => $request->product_name_ph,	
            'product_slug_en' => Str::slug($request->product_name_en, '-'),  	
            'product_slug_ph' => Str::slug($request->product_name_ph, '-'),  	
            'product_code' => $request->product_code,	
            'product_qty' => $request->product_qty,	
            'product_tags_en' => $request->product_tags_en,	
            'product_tags_ph' => $request->product_tags_ph,	
            'product_size_en' => $request->product_size_en,	
            'product_size_ph' => $request->product_size_ph,	
            'product_color_en' => $request->product_color_en,	
            'product_color_ph' => $request->product_color_ph,	
            'product_prize' => $request->product_price,	
            'product_discount' => $request->product_discount,	
            'product_descp_short_en' => $request->product_descp_short_en,	
            'product_descp_short_ph' => $request->product_descp_short_ph,	
            'product_descp_long_en' => $request->product_descp_long_en,	
            'product_descp_long_ph' => $request->product_descp_long_ph,	            
            'ishot_deals' => $request->ishot_deals,
            'isfeatured' => $request->isfeatured,
            'isspecialoffer' => $request->isspecialoffer,
            'isspecialdeals' => $request->isspecialdeals,
            'product_status'=>1,
            'product_thumbnail' => $image_path            
        ]);


        if($request->file('multi_img')){

            $product_images = MultiImg::where('product_id',$product_id)->get();
            foreach($product_images as $product_image){
                @unlink(public_path($product_image->image_name));
                $product_image->delete();
            }

            

            $multi_images = $request->file('multi_img') ;

            foreach($multi_images as $multi_image){
                $multi_image_name = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
                
                $multi_image_path='uploads/products/'.$request->product_code.'/images/'.$multi_image_name;
                Image::make($multi_image)->resize(917,1000)->save($multi_image_path);
    
                MultiImg::insert([
                    'product_id' => $product_id,
                    'image_name' => $multi_image_path,
                    'created_at'=>  Carbon::now()
                ]);
            }    

        }

    
        
        $toastrMsg=array(
            'message' => 'Product Updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('products.all')->with($toastrMsg);

    }

    public function status ($id){
        $product = Product::findOrFail($id);
        if ($product->product_status==1){
            $product->product_status=0;
        }
        else{
            $product->product_status=1;
        }
        $product->save();
        $toastrMsg=array(
            'message' => 'Done!',
            'alert-type' => 'success'
        );
        return redirect()->route('products.all')->with($toastrMsg);

    }

    public function delete($id){
        $product=Product::findOrFail($id);
        @unlink(public_path($product->product_thumbnail));
        
        
        $product_images = MultiImg::where('product_id',$id)->get();
        foreach($product_images as $product_image){
            @unlink(public_path($product_image->image_name));
            $product_image->delete();
        }

        $product->delete();


        $toastrMsg=array(
            'message' => 'Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('products.all')->with($toastrMsg);
    }

    
        // public function test($id){
        //     $product = Product::findOrFail($id);
        //     $categories = Category::with(['subsubcategory_pivot','subcategory'])->latest()->get();
        //     $multi_images = MultiImg::where('product_id',$product->id)->get();
            
        //     //dd($categories);
        //     //dd($categories->subcategory->subsubcategory_pivot);
        //     // foreach($categories as $category){
        //     //     echo $category->category_name_en;
        //     //     foreach($category->subcategory as $subcategory){
        //     //         echo $subcategory->subcategory_name_en;
        //     //         foreach ($category->subsubcategory_pivot as $subsubcategory){
        //     //             echo $subsubcategory->subcategory_name_en;
        //     //         }
                    
        //     //     }
        //     //     echo "<br>";
        //     // }
            

        //     return view('test',compact('categories'));
        // }
    

}
