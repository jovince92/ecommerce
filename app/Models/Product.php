<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function subsubcategory(){
        return $this->hasOne(SubSubCategory::class,'id','subsubcategory_id');
    }

    public function subcategory(){
        return $this->hasOne(SubCategory::class,'id','subcategory_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function review(){
        return $this->hasMany(Review::class,'id','product_id');
    }
}
