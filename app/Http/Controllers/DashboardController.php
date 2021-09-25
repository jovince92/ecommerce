<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function orders(){

        $orders = Order::with('getstatus')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('profile.orders',compact('orders'));

    }



    public function orders_show($id,$handle = null){
        $invoice = Order::with(['country','state','city','getstatus'])->where('user_id',Auth::id())->where('id',$id)->first();
        
        if(!$invoice){
            abort(404);
        }
        
        $orderdetails=OrderDetail::with(['order','product'])
        ->where('order_id',$id)
        ->whereHas('order', function ($q) {
            $q->where('user_id',Auth::id());
        })->orderBy('id','DESC')->get(); 

        

        if($handle=="invoice"){
            set_time_limit(240);


            $pdf = PDF::loadView('profile.invoice',compact('orderdetails','invoice'))->setOptions([
                'tempDir'=>public_path(),
                'chroot'=>public_path()
            ]);
            return $pdf->download('invoice.pdf');
            //return view('profile.invoice',compact('orderdetails','invoice'));
        }else{
            return view('profile.orderdetails',compact('orderdetails','invoice'));
        }
    }

    public function cancelorder($id){
        $order=Order::findOrFail($id);

        $products = OrderDetail::where('order_id',$id)->get();
        
        foreach($products as $product){            
            if($order->status!=1){
                Product::where('product_code',$product->product_id)->increment('product_qty',$product->qty);
            }   
        }
        
        $order->update([
            'status'=>7,
            'canceled_date'=>now()
        ]);


        $toastrMsg=array(
            'message' => 'Order Cancelled!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    public function returnrequest(Request $request){
        Order::findOrFail($request->order_id)->update([
            'returned_date'=>now(),
            'return_reason'=>$request->return_reason,
            'status'=>8
        ]);

        $toastrMsg=array(
            'message' => 'Return/refurn request sent!',
            'alert-type' => 'success',
            
        );
        return redirect()->back()->with($toastrMsg);

    }

}
