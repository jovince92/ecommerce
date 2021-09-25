<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function city(){
        return $this->hasMany(City::class,'state_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
