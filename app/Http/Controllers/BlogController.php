<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index(){
        $blogposts = BlogPost::orderBy('created_at')->get();
        return view('admin.blog.posts',compact('blogposts'));
    }

    public function create(){
        return view('admin.blog.post_add');
    }


    public function store(Request $request){
        $image = $request->file('post_image') ;
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
        Image::make($image)->resize(780,433)->save('uploads/blogposts/'.$image_name);
        //dd($test);
        //dd($request);
        BlogPost::create([
            'post_title_en' =>$request->post_title_en,
            'post_title_ph' =>$request->post_title_ru,
            'post_details_en' =>$request->post_details_en,
            'post_details_ph' =>$request->post_details_ru,
            'tags_en' =>$request->post_tags_en,
            'tags_ph' =>$request->post_tags_ru,
            'post_slug_en' =>Str::slug($request->post_title_en, '-'),
            'post_slug_ph' =>Str::slug($request->post_title_ru, '-'),
            'post_image' =>'uploads/blogposts/'.$image_name,
            
        ]);
        $toastrMsg=array(
            'message' => 'POSTED!',
            'alert-type' => 'success'
        );
        return redirect()->route('blogs.all')->with($toastrMsg);
    }

    public function edit($id){
        $blogpost=BlogPost::findOrFail($id);
        return view('admin.blog.post_edit',compact('blogpost'));
    }

    public function update(Request $request){
        $imagepath="";
        
        $data=BlogPost::findOrFail($request->id);
        
        if($request->file('post_image')){
            $file=$request->file('post_image');            
            @unlink(public_path($data->post_image));
            $image = $request->file('post_image') ;
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //$test=Image::make($image)->resize(300,300)->save('uploads/brands/'.$image_name);
            Image::make($image)->resize(780,433)->save('uploads/blogposts/'.$image_name);
            $imagepath='uploads/blogposts/'.$image_name;  
        }else{
            $imagepath=$data->post_image;
        }

        

        $data->update([
            'post_title_en' =>$request->post_title_en,
            'post_title_ph' =>$request->post_title_ru,
            'post_details_en' =>$request->post_details_en,
            'post_details_ph' =>$request->post_details_ru,
            'tags_en' =>$request->post_tags_en,
            'tags_ph' =>$request->post_tags_ru,
            'post_slug_en' =>Str::slug($request->post_title_en, '-'),
            'post_slug_ph' =>Str::slug($request->post_title_ru, '-'),
            'post_image'=>$imagepath
        ]);
        

        $toastrMsg=array(
            'message' => 'Blog Post Updated! - TEST',
            'alert-type' => 'success'
        );

        return redirect()->route('blogs.all')->with($toastrMsg);
    }


    public function delete($id){
        $post=BlogPost::findOrFail($id);
        @unlink(public_path($post->post_image));

        BlogPost::findOrFail($id)->delete();

        $toastrMsg=array(
            'message' => 'Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('blogs.all')->with($toastrMsg);
        
    }


    public function frontpageblogs_index(){
        $blogposts = BlogPost::orderBy('created_at','DESC')->get();
        return view('mainpage.blogposts.blogs',compact('blogposts'));
    }

    public function frontpageblogs_show($slug){
        $post = BlogPost::where('post_slug_en',$slug)->first();
        return view('mainpage.blogposts.blogdetails',compact('post'));
    }
}
