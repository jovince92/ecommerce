<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubCategory extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'category_id',
        'subcategory_id',
        'subsubcategory_name_en',
        'subsubcategory_name_ph',
        'subsubcategory_slug_en',
        'subsubcategory_slug_ph'        
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function products(){
        return $this->hasMany(Product::class,'subsubcategory_id','id')->orderBy('product_name_en');
    }
}
