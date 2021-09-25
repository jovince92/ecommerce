<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function state(){
        return $this->hasMany(State::class,'country_id','id');
    }
    public function city(){
        return $this->hasManyThrough(City::class,State::class,'country_id','state_id','id','id');
    }
}
