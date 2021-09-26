<?php

namespace App\Http\Controllers\main;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    

    public function index(){
        return view('mainpage.products.mycart');
    }

    public function show(){
        $cart = array();
        $cart['cart_items'] = Cart::content();
        $cart['cart_count'] = Cart::count();
        $cart['cart_total'] = Cart::total();
        
        return json_encode(compact('cart'));
    }

    public function update(Request $request){
        $rowId = $request->rowId;
        $increment = intval($request->increment);
        $qty=Cart::get($rowId)->qty;
        $increment=$qty+$increment;
        Cart::update($rowId,$increment);

        return json_encode([
            'rowId'=>$rowId,
            'step'=>$increment
        ]);

    }


    public function add(Request $request){

        $price=0.00;
        
        $product = Product::where("product_code",$request->productcode)->first();
        
        if ($product->product_discount!=null){
            $price = $product->product_prize-($product->product_prize* ($product->product_discount*0.010 ));
        }
        else{
            $price=$product->product_prize;
        }
        $price=round($price,2);
        //Cart::destroy();
        Cart::add([
            "id"=>$request->productcode,
            "name"=>$product->product_name_en,            
            "qty"=>$request->prodqty,
            "price"=>$price,
            'weight' => 0,
            'options' => ['size' => $request->productsize,
                    'color' => $request->productcolor,
                    'image' => asset($product->product_thumbnail),
                    'max_qty' => $product->product_qty
                    ]
        ]);

        

        

        $response = array("message"=>"added to cart");

        return json_encode($response);

    }

    public function headerCart(){
        
        $cart = array();
        $cart['cart_items'] = Cart::content();
        $cart['cart_count'] = Cart::count();
        $cart['cart_total'] = Cart::subtotal();

        return json_encode(compact('cart'));
    }

    public function remove($rowId){
        Cart::remove($rowId);
        $response = array("message"=>"removed from cart");
        return json_encode($response);
    }

    public function clear(){
        Cart::destroy();
        $response = array("message"=>"cart cleared");
        return json_encode($response);
    }

    public function apply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->couponName)->first();
        
        

        if (!$coupon){            
            return json_encode(["applied"=>0,"message"=>"Invalid coupon"]);
        }
        else {  
            if ($coupon->coupon_validity<now()){
                return json_encode(["applied"=>0,"message"=>"Coupon expired!"]);
            }else{
                
                $total = 0.00;
                $total = round(floatval(Cart::subtotalfloat()),2);

                Cart::setGlobalDiscount($coupon->coupon_discount);
                Session::put('coupon',[
                    'coupon_name'=>$coupon->coupon_name,
                    'coupon_discount'=>$coupon->coupon_discount,
                    'discounted_price'=>$total - ($total*($coupon->coupon_discount*0.010)),                    
                    'total_price'=>$total
                ]);
                return json_encode(["applied"=>1,"message"=>"Coupon Applied!!"]);
            }
        }
    }

    public function applied(){
        
        
        $total = floatval(Cart::subtotalfloat());        
        $total = round($total,2);
        $totalBeforeDiscount = floatval(Cart::subtotalfloat());   
        $initialtotal = floatval(Cart::initialfloat());   
        $yousave=(Cart::discount());
        if(Session::has('coupon')){
            
            
            return json_encode([
                'coupon_name'=>session()->get('coupon')['coupon_name'],
                'coupon_discount'=>session()->get('coupon')['coupon_discount'],
                'total_price'=>round($initialtotal,2),
                'you_save'=>$yousave,
                'discounted_price'=>round($totalBeforeDiscount,2)
            ]);
        }else{
            
            return json_encode([
                
                'total'=>$total
            ]);
        }

    }

    public function couponRemove(){
        Session::forget('coupon');
        Cart::setGlobalDiscount(0);
        return json_encode([
            "message"=>"Coupon removed!"
        ]);
    }

    public function checkout(){
        
        // Cart::setGlobalTax(0);
        
        $countries=Country::orderBy('name')->get();

        
        $cart_items = Cart::content();
        $cart_count=Cart::count();
        $cart_totalbeforediscount = round(floatval(Cart::initialfloat()),2);
        $cart_totalafterdiscount =  round(floatval(Cart::subtotalfloat()),2);
        $coupon="n/a";
        if(Session::has('coupon')){
            $coupon=session()->get('coupon')['coupon_name']."|".session()->get('coupon')['coupon_discount']."% discount!";
        }


        if (Auth::check()){
            if(Cart::count()>0){

                
                
                return view('mainpage.checkout',compact('countries','cart_items','cart_count','cart_totalbeforediscount','cart_totalafterdiscount','coupon'));

            }else{
                $toastrMsg=array(
                    'message' => 'Cart is empty!',
                    'alert-type' => 'success'
                );
        
                return redirect()->route('cart.index')->with($toastrMsg);
            }
        }else{
            $toastrMsg=array(
                'message' => 'Log in first!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('cart.index')->with($toastrMsg);
        }
    }

}
