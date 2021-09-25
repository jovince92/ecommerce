<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SEO;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index(){
        $settings = SiteSetting::findOrFail(1);
        return view('admin.sitesettings.settings',compact('settings'));
    }

    public function update(Request $request){

        //dd($request);

        $imagepath="";
        $faviconpath="";

        $data=SiteSetting::findOrFail(1);
        
        if($request->file('site_logo')){
            $file=$request->file('site_logo');            
            @unlink(public_path($data->site_logo));
            $image = $request->file('site_logo') ;
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //$test=Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
            Image::make($image)->resize(278,72)->save('uploads/sitelogo/'.$image_name);
            $imagepath='uploads/sitelogo/'.$image_name;  
        }else{
            $imagepath=$data->site_logo;
        }

        if($request->file('site_favicon')){
            $file=$request->file('site_favicon');            
            @unlink(public_path($data->site_favicon));
            $favicon = $request->file('site_favicon') ;
            $favicon_name = hexdec(uniqid()).'.'.$favicon->getClientOriginalExtension();
            //$test=Image::make($favicon)->resize(300,300)->save('uploads/brands/'.$favicon_name);
            Image::make($favicon)->resize(40,40)->save('uploads/sitefavicon/'.$favicon_name);
            $faviconpath='uploads/sitefavicon/'.$favicon_name;  
        }else{
            $faviconpath=$data->site_favicon;
        }

        

        $data->update([
            'site_logo'=>$imagepath,
            'site_favicon'=>$faviconpath,
            'email' =>$request->email,
            'phone_1' =>$request->phone_1,
            'phone_2' =>$request->phone_2,
            'company_name' =>$request->company_name,
            'company_address' =>$request->company_address,
            'company_facebook' =>$request->company_facebook,
            'company_twitter' =>$request->company_twitter,
            'company_linkedin' =>$request->company_linkedin,
            'company_youtube' =>$request->company_youtube,
        ]);
        

        $toastrMsg=array(
            'message' => 'Site settings updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastrMsg);
    }
    
    public function seo(){
        $seo=SEO::findOrFail(1);

        return view('admin.sitesettings.seo',compact('seo'));
    }

    public function update_seo(Request $request){
        //dd($request);
        $data=SEO::findOrFail(1)->update([            
            'meta_title' =>$request->meta_title,
            'meta_author' =>$request->meta_author,
            'meta_keyword' =>$request->meta_keyword,
            'meta_description' =>$request->meta_description,
            'google_analytics' =>$request->google_analytics            
        ]);
        

        $toastrMsg=array(
            'message' => 'SEO settings updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastrMsg);
    }
}
