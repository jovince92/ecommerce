<?php

namespace App\Http\Controllers\user;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\State;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout_store(Request $request){
        //dd($request);

        $country=Country::findOrFail($request->country);
        $state=State::findOrFail($request->state);
        $city=City::findOrFail($request->city);
        $address=$request->address." ".$request->postcode.", ".$city->name.", ".$state->name.", ".$country->name;
        $data=array([
            'city_id'=>$request->city,
            'state_id'=>$request->state,
            'country_id'=>$request->country,
            'city'=>$city->name,
            'state'=>$state->name,
            'country'=>$country->name,
            'complete_address'=>$address,
            'shipping_name'=>$request->name,
            'shipping_address_line'=>$request->address,
            'shipping_email'=>$request->email,
            'shipping_phone'=>$request->phone,
            'postcode'=>$request->postcode,
            'notes'=>$request->notes
        ]);


        
        $cart_items = Cart::content();
        $cart_count=Cart::count();
        $cart_totalbeforediscount =floatval(Cart::initialfloat());
        $cart_totalafterdiscount = floatval(Cart::subtotalfloat());
        $coupon="n/a";
        if(Session::has('coupon')){
            $coupon=session()->get('coupon')['coupon_name']."|".session()->get('coupon')['coupon_discount']."% discount!";
        }


        if($request->paymentMethod=='stripe'){
            return view('mainpage.paymentmethods.stripe',compact('data','cart_items','cart_count','cart_totalbeforediscount','cart_totalafterdiscount','coupon'));
        }else{
            return view('mainpage.paymentmethods.card',compact('data','cart_items','cart_count','cart_totalbeforediscount','cart_totalafterdiscount','coupon'));
        }

    }


    public function stripe(Request $request){
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        Stripe::setApiKey('sk_test_51JZcX1EICKb0t7I849fDQPZ4muFsu2bj76x3hoSWwfJTuXrs0liCTcAzobno13bofjiAopwiqKQdMWrBTK4EUCjg001Dw3c54O');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;

        $orderNo=uniqid();

        $charge = Charge::create([ //---------reload window if PHP Error---------//
            'amount' => round($request->total*100.00,2),
            'currency' => 'usd',
            'description' => 'test E-commerce',
            'source' => $token,
            'metadata' =>[
                'order_id'=>$orderNo
            ]
        ]);
        //dd($charge);

        $order_id=Order::create([
            'user_id'=>Auth::id(),
            'city_id'=>$request->city_id,
            'state_id'=>$request->state_id,
            'country_id'=>$request->country_id,
            'name'=>$request->name,
            'address_line'=>$request->address_line,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'postcode'=>$request->postcode,
            'notes'=>$request->notes,
            'payment_type'=>'Stripe',
            'payment_method'=>$charge->payment_method,
            'transaction_id'=>$charge->balance_transaction,
            'currency'=>$charge->currency,
            'amount' => round($request->total,2),
            'order_number'=>$orderNo,
            'invoice_number'=>'INVOICE'.mt_rand(10000000,99999999),
            'order_date'=>now(),
            'status'=>1
        ])->id;

        $cart_items=Cart::content();

        foreach($cart_items as $item){
            OrderDetail::create([
                'order_id'=>$order_id,
                'product_id'=>$item->id,
                'color'=>$item->options->color,
                'size'=>$item->options->size,
                'qty'=>$item->qty,
                'price'=>$item->price,
            ]);
        }

        Cart::destroy();
        if (Session::has('coupon')){
            Session::forget('coupon');
        }


        return redirect()->route('payments.success',$order_id);

    }

    public function paymentsuccess($id){

        $order = Order::findOrFail($id);
        $details=[
            'invoice_number'=>$order->invoice_number,
            'amount'=>$order->amount,
            'name'=>$order->name
        ];

        Mail::to($order->email)->send(new OrderConfirmation($details));




        $toastrMsg=array(
            'message' => 'Order Placed! Check email for confirmation',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($toastrMsg);
    }
}


