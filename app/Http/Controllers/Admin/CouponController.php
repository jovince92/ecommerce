<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CouponController extends Controller
{
    public function index(){
        $coupons=Coupon::latest()->get();
        return view('admin.coupons.coupons',compact('coupons'));
        
    }


    public function edit($id){
        $coupon=Coupon::findOrFail($id);
        return view('admin.coupons.coupons_edit',compact('coupon'));
    }

    public function delete($id){
        Coupon::findOrFail($id)->delete();
        
        $toastrMsg=array(
            'message' => 'Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('coupons.all')->with($toastrMsg);
    }

    public function status ($id){

        $coupon = Coupon::findOrFail($id);
        if ($coupon->coupon_status==1){
            $coupon->coupon_status=0;
        }
        else{
            $coupon->coupon_status=1;
        }
        $coupon->save();
        $toastrMsg=array(
            'message' => 'Done!',
            'alert-type' => 'success'
        );
        return redirect()->route('coupons.all')->with($toastrMsg);

    }

    public function update(Request $request){
        $coupon=Coupon::findOrFail($request->coupon_id);
        
        $coupon->update([
            'coupon_name'=>Str::upper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity'=>$request->coupon_validity
        ]);

        $toastrMsg=array(
            'message' => 'Coupon Updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('coupons.all')->with($toastrMsg);

    }

    public function store(Request $request){

        $validated = $request->validate([
            'coupon_name' => 'required',            
            'coupon_discount' => 'required',    
            'coupon_validity' => 'required'
        ]);

        Coupon::create([
            'coupon_name'=>Str::upper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity'=>$request->coupon_validity
        ]);

        $toastrMsg=array(
            'message' => 'Coupon Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }
}
