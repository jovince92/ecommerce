<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;

class ShippingAreaController extends Controller
{
    public function cities_index(){
        $countries=Country::orderBy('name')->get();
        return view('admin.shipping.cities',compact('countries'));
    }

    public function states_ajax($id){
        $countries=State::with(['city','country'])->where('country_id',$id)->orderBy('name')->get();
        
        return json_encode($countries);
    }

    public function cities_ajax($id){
        $countries=State::where('country_id',$id)->orderBy('name')->get();
        
        return json_encode($countries);
    }

    public function cities_all($id){
        $cities=City::where('state_id',$id)->orderBy('name')->get();
        
        return json_encode($cities);
    }


    public function states_cities($id){
        //$countries=City::with('state')->where('state_id',$id)->orderBy('name')->get();
        $countries=State::with(['city','country'])->where('id',$id)->orderBy('name')->get();
        
        return json_encode($countries);
        
    }

    public function cities_create(Request $request){
       
        City::create([
            'state_id'=>$request->state2,
            'name'=>$request->city_name
        ]);

        $toastrMsg=array(
            'message' => 'City Added!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
        
    }

    public function cities_delete($id){
       
        City::findOrFail($id)->delete();

        $toastrMsg=array(
            'message' => 'City Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($toastrMsg);
        
    }

    public function statuses_index(){
        $statuses = Status::orderBy('id','desc')->get();
        return view('admin.shipping.statuses',compact('statuses'));
    }
}
