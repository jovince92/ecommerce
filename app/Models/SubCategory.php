<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'category_id',
        'subcategory_name_en',
        'subcategory_name_ph',
        'subcategory_slug_en',
        'subcategory_slug_ph'        
    ];


    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subsubcategory(){
        return $this->hasMany(SubSubCategory::class,'subcategory_id','id');
    }
}
