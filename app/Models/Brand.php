<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable =[
        'brand_name_en',
        'brand_name_ph',
        'brand_slug_en',
        'brand_slug_ph',
        'brand_image'
    ];

    public function product(){
        return $this->hasMany(Product::class,'brand_id','id');
    }


}
