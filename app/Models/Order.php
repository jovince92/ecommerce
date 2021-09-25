<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function state(){
        return $this->hasOne(State::class,'id','state_id');
    }

    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class,'id','order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getstatus(){
        return $this->hasOne(Status::class,'id','status');
    }

    

}
