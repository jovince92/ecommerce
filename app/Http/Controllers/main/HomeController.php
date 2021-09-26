<?php

namespace App\Http\Controllers\main;

use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::with(['subsubcategory',
            'subcategory'])
            ->orderBy('category_name_en')
            ->get();

        $blogposts = BlogPost::orderBy('created_at','DESC')->get();
            
        $sliders = Slider::where('status',1)->limit(4)->get();
        $products = Product::with('category','review')->where('product_status',1)->latest()->get();
        return view('mainpage.index',compact('categories','sliders','products','blogposts'));
    }



    public function productsShow($slug){
        
        $product=Product::with(['category','subcategory','subsubcategory'])->where('product_slug_en',$slug)->firstOrFail();


        $b1=([
            'en'=>$product->category->category_name_en,
            'ru'=>$product->category->category_name_ph,
            'slug'=>$product->category->category_slug_en
        ]);

        $b2=([
            'en'=>$product->subcategory->subcategory_name_en,
            'ru'=>$product->subcategory->subcategory_name_ph,
            'slug'=>$product->subcategory->subcategory_slug_en
        ]);

        $b3=([
            'en'=>$product->subsubcategory->subsubcategory_name_en,
            'ru'=>$product->subsubcategory->subsubcategory_name_ph,
            'slug'=>$product->subsubcategory->subsubcategory_slug_en,
        ]);

        


        if(!$product->product_size_en){
            $product->product_size_en = "n/a";
        }
        if(!$product->product_size_ph){
            $product->product_size_ph = "n/a";
        }

        $product_color_en = explode(",",$product->product_color_en);
        $product_color_ru = explode(",",$product->product_color_ph);

        $product_size_en = explode(",",$product->product_size_en);
        $product_size_ru = explode(",",$product->product_size_ph);

        
        $reviews=Review::with('user')->where('product_id',$product->id)->where('status',1)->orderBy('created_at','DESC')->get();

        $avg_rating=0;
        if ($reviews->count()>0){
            $avg_rating = round($reviews->avg('rating'),2);
        }
        


        $relatedProducts = Product::where('product_status',1)->where('id','!=',$product->id)->where('category_id',$product->category_id)->orderBy('updated_at','DESC')->orderBy('created_at','DESC')->get();
        $multiImg=MultiImg::where('product_id',$product->id)->orderBy('image_name')->get();
        return view('mainpage.products.productdetails',compact('product','multiImg','product_color_en','product_color_ru','product_size_en','product_size_ru','relatedProducts','reviews','b1','b2','b3','avg_rating'));
    }

    public function productsSubSubCategorized($subsubslug){
        $subsubcategory=SubSubCategory::with(['category','subcategory'])->where('subsubcategory_slug_en',$subsubslug)->firstOrFail();
        $products = Product::with('review')->where('subsubcategory_id',$subsubcategory->id)->where('product_status',1)->orderBy('product_name_en')->get();
        $title['en'] = $subsubcategory->subsubcategory_name_en;
        $title['ru'] = $subsubcategory->subsubcategory_name_ph;

        $b1=([
            'en'=>$subsubcategory->category->category_name_en,
            'ru'=>$subsubcategory->category->category_name_ph,
            'slug'=>$subsubcategory->category->category_slug_en
        ]);

        $b2=([
            'en'=>$subsubcategory->subcategory->subcategory_name_en,
            'ru'=>$subsubcategory->subcategory->subcategory_name_ph,
            'slug'=>$subsubcategory->subcategory->subcategory_slug_en
        ]);

        $b3=([
            'en'=>$subsubcategory->subsubcategory_name_en,
            'ru'=>$subsubcategory->subsubcategory_name_ph,
        ]);

        return view('mainpage.products.products_list',compact('products','title','b1','b2','b3'));
    }

    public function productsSubCategorized($subslug){
        $subcategory=SubCategory::with('category')->where('subcategory_slug_en',$subslug)->firstOrFail();
        $products = Product::with('review')->where('subcategory_id',$subcategory->id)->where('product_status',1)->orderBy('product_name_en')->get();
        $title['en'] = $subcategory->subcategory_name_en;
        $title['ru'] = $subcategory->subcategory_name_ph;

        $b1=([
            'en'=>$subcategory->category->category_name_en,
            'ru'=>$subcategory->category->category_name_ph,
            'slug'=>$subcategory->category->category_slug_en,
        ]);

        $b2=([
            'en'=>$subcategory->subcategory_name_en,
            'ru'=>$subcategory->subcategory_name_ph,
        ]);


        return view('mainpage.products.products_list',compact('products','title','b1','b2'));
    }

    public function productsCategorized($catslug){
        $category=Category::where('category_slug_en',$catslug)->firstOrFail();
        
        $products = Product::with('review')->where('category_id',$category->id)->where('product_status',1)->orderBy('product_name_en')->get();
        $title['en'] = $category->category_name_en;
        $title['ru'] = $category->category_name_ph;

        $b1=([
            'en'=>$category->category_name_en,
            'ru'=>$category->category_name_ph,
        ]);

        return view('mainpage.products.products_list',compact('products','title','b1'));
    }

    public function productsCart($slug){
        $product = Product::with(['category','brand','review'])->where('product_slug_en',$slug)->first();
        return json_encode(compact('product'));
    }

    /**************************************************************************** */
    public function show(){
        $id=Auth::user()->id;
        $user=User::find($id);
        
        return view('mainpage.profile',compact('user'));
    }

    public function store(Request $request){
        
        $data=User::find(Auth::user()->id);
        //dd(public_path('storage/profile-photos/'.$data->profile_photo_path));
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('storage/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName  ();
            $file->move(public_path('storage\profile-photos'),$filename);
            $data['profile_photo_path']='profile-photos/'.$filename;  
        }
        $data->save();

        $toastrMsg=array(
            'message' => 'Profile Updated! - TEST',
            'alert-type' => 'success'
        );

        return redirect()->route('profile')->with($toastrMsg);
    }

    public function passwordShow(){        
        return view('mainpage.changepassword');
    }

    public function passwordStore(Request $request){
        $data=$request->validate([
            'old_password' =>'required',
            'password' =>'required|confirmed',
        ]);

        $userData=User::find(Auth::user()->id);

        $password=$userData->password;
        if(Hash::check($request->old_password,$password)){
            $user =    $userData;
            $user->password = Hash::make($request->password);
            $user->save();
            
            $toastrMsg=array(
                'message' => 'Password Changed!',
                'alert-type' => 'success'
            );
            return redirect()->route('profile')->with($toastrMsg);
            //Auth::logout();
        }
        else{
            $toastrMsg=array(
                'message' => 'Old password wrong!',
                'alert-type' => 'warning'
            );
            return redirect()->route('password.show')->with($toastrMsg);
        }

    }

    public function ordertracking(Request $request){
        
        $invoice=$request->invoice;
        $order = Order::with(['getstatus','city','country','state','user'])->where('invoice_number',$invoice)->where('user_id',Auth::id())->first();
        

        if($order){
            $orderdetails = OrderDetail::with('product')->where('order_id',$order->id)->get();
            return view('mainpage.tracking.tracking',compact(['order','orderdetails']));
        }else{
            $toastrMsg=array(
                'message' => 'Invalid Invoice Number!!',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($toastrMsg);
        }


    }


    public function search(Request $request){

        $slug = $request->search;

        $products = Product::with('review')->where('product_name_en','LIKE','%'.$slug.'%')->orderBy('product_name_en')->get();
        
        $title['en'] = 'Search for '.$slug;
        $title['ru'] = 'Искать '.$slug;

        $b1=([
            'en'=>'Search for '.$slug,
            'ru'=>'Искать '.$slug
        ]);

        return view('mainpage.products.products_list',compact('products','title','b1'));
        

    }


    public function search_ajax(Request $request){
        $slug = $request->search;

        $products = Product::where('product_name_en','LIKE','%'.$slug.'%')
            ->select('product_name_en','product_thumbnail','product_slug_en',)
            ->limit(5)
            ->orderBy('product_name_en')->get();

        return view('mainpage.layouts.search_tooltip',compact('products'));
        //return json_encode($products);
    }
}
