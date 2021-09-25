<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index($lang){
        session()->get('language');
        session()->forget('language');
        if($lang=='eng'){            
            Session::put('language','eng');
        }
        elseif($lang=='rus'){
            Session::put('language','rus');
        }
        else{
            Session::put('language','eng');
        }
        return redirect()->back();
    }
}
