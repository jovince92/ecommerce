<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function pending(){

        $orders=Order::with('getstatus')->where('status',1)->orderBy('created_at','DESC')->get();
        //dd($orders);
        return view('admin.orders.index',compact('orders'));
    }

    public function confirmed(){

        $orders=Order::with('getstatus')->where('status',2)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function inprogress(){
        $orders=Order::with('getstatus')->where('status',3)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function pickedup(){
        $orders=Order::with('getstatus')->where('status',4)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function shipped(){
        $orders=Order::with('getstatus')->where('status',5)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function delivered(){
        $orders=Order::with('getstatus')->where('status',6)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function cancelled(){
        $orders=Order::with('getstatus')->where('status',7)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function returned(){
        $orders=Order::with('getstatus')->where('status',8)->orderBy('created_at','DESC')->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function show($id){
        $order = Order::with(['country','state','city','getstatus'])->where('id',$id)->first();
        $orderdetails=OrderDetail::with(['order','product'])->where('order_id',$id)->orderBy('id','DESC')->get();
        
        return view('admin.orders.details',compact('order','orderdetails'));

    }

    public function update($id){
        
        $order = Order::findOrFail($id);
        $status = intval($order->status)+1;        

        switch($status){
            case (2):
                $order->update(['confirmation_date'=>now(),'status'=>$status]);
                $products = OrderDetail::where('order_id',$id)->get();
                //dd($products);
                foreach($products as $product){
                    // Product::where('product_code',$product->product_id)->update([
                    //     'product_qty'=>DB::raw('product_qty-'.$product->qty)
                    // ]);
                    Product::where('product_code',$product->product_id)->decrement('product_qty',$product->qty);

                }
                break;
            case (3):
                $order->update(['processing_date'=>now(),'status'=>$status]);
                break;
            case (4):
                $order->update(['pickup_date'=>now(),'status'=>$status]);
                break;
            case (5):
                $order->update(['shipping_date'=>now(),'status'=>$status]);
                break;
            case (6):
                $order->update(['delivered_date'=>now(),'status'=>$status]);
                break;
        }


        $toastrMsg=array(
            'message' => 'This has been done!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    public function cancel($id){
        
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
            'message' => 'This has been cancelled!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }
}
