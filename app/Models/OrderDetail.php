<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function product(){
        return $this->hasOne(Product::class,'product_code','product_id');
    }
}
