<?php

namespace App\Models;

use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable =[
        'category_name_en',
        'category_name_ph',
        'category_slug_en',
        'category_slug_ph',
        'category_icon'
    ];

    public function subcategory(){
        return $this->hasMany(SubCategory::class,'category_id','id')->orderBy('subcategory_name_en');
    }

    public function subsubcategory(){
        return $this->hasMany(SubSubCategory::class,'category_id','id')->orderBy('subsubcategory_name_en');
    }

    public function subsubcategory_pivot(){
        return $this->hasManyThrough(SubSubCategory::class,SubCategory::class,'category_id','subcategory_id','id','id');
    }



    
}
