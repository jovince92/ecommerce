<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $admin=Admin::find(Auth::id());
        //dd(compact('admin'));
        //dd($admin->profile_photo_path);
        //dd(asset($admin->profile_photo_path'storage/profile-photos/'.$admin->profile_photo_path));
        //unset($admin->profile_photo_path);
        if (empty($admin->profile_photo_path)){
            $admin->profile_photo_path ='default.png';
        }
        
        
        //dd($admin->profile_photo_path);
        return view('admin.profile',compact('admin'));
    }

    public function edit(){
        //dd(public_path('profile-photos\admin'));
        $admin=Admin::find(Auth::id());
        if (empty($admin->profile_photo_path)){
            $admin->profile_photo_path ='default.png';
        }
        return view('admin.edit',compact('admin'));
    }   

    public function store(Request $request){
        //return (dd($request));
        $data=Admin::find(Auth::id());
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('storage/profile-photos/admin/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName  ();
            $file->move(public_path('storage\profile-photos\admin'),$filename);
            $data['profile_photo_path']=$filename;  
        }
        $data->save();

        $toastrMsg=array(
            'message' => 'Profile Updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($toastrMsg);

    }

    public function storePassword(Request $request){
//        dd($request);

        

        $data=$request->validate([
            'old_password' =>'required',
            'password' =>'required|confirmed',
        ]);

        

        $password=Admin::find(Auth::id())->password;
        if(Hash::check($request->old_password,$password)){
            $admin =    Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }
        else{
            $toastrMsg=array(
                'message' => 'Old password wrong!',
                'alert-type' => 'info'
            );
            return redirect()->route('admin.edit')->with($toastrMsg);
        }
    }

}
