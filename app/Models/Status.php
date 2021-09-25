<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function orderstatus(){
        return $this->belongsTo(Order::class,'status','id');
    }
}
