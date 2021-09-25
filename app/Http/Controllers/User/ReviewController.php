<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $request){
        $review = Review::create([
            'user_id'=>Auth::id(),
            'product_id'=>$request->product_id,
            'summary'=>$request->summary,
            'review'=>$request->review,
            'rating'=>$request->rating,
        ]);

        $toastrMsg=array(
            'message' => 'Review has been submited for approval!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }

    public function index(){
        $reviews=Review::with(['user','product'])->orderBy('created_at','DESC')->get();
        return view('admin.sitesettings.reviews',compact('reviews'));
    }

    public function approve($id){
        $review = Review::findOrFail($id)->update(['status'=>1]);
        $toastrMsg=array(
            'message' => 'Review has been Approved!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
    }
}
