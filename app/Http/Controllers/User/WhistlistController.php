<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whistlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhistlistController extends Controller
{
    public function index(){
        $wishlist = Whistlist::with('product')->where('user_id',Auth::id())->orderBy('updated_at','DESC')->get();
        

        
        return view('mainpage.products.wishlist',compact('wishlist'));

    }

    public function show(){
        $wishlist = Whistlist::with('product')->where('user_id',Auth::id())->orderBy('updated_at','DESC')->get();
        
        return json_encode (compact('wishlist'));

    }

    public function delete(Request $request){
        Whistlist::findOrFail($request->id)->delete();
        return json_encode(["message"=>"Removed from wishlist"]);
    }

    


    public function add(Request $request){

        
        $product = Product::where('product_code',$request->productcode)->first();
        $id=$product->id;

        $request = array();
        if (Auth::check()){
            
            $checkIfWishlisted = Whistlist::where('user_id',Auth::id())->where('product_id',$id)->first();

            if($checkIfWishlisted){
                Whistlist::findOrFail($checkIfWishlisted->id)->delete();
                $response = ["message"=>"Removed from wishlist","action"=>1];
                
            }else{
                $wishlist=Whistlist::create([
                    'user_id'=>Auth::id(),
                    'product_id'=>$id
                ]);
                $response = ["message"=>"Added to wishlist","action"=>0];

                
            }

            

            
            
            
            

        }else{
            $response = ["message"=>"LOG IN FIRST!","action"=>""];
        }
        return json_encode($response);

    }
}
