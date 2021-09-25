<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Cache as FacadesCache;

class UserRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        // if(Auth::check()){
        //     $expireTime = now()->addSeconds(30);
        //     FacadesCache::put('user-is-online'.Auth::user()->id,true,$expireTime);
        //     User::where('id',Auth::user()->id)->update(['last_seen'=>now()]);

        // }

        if((Auth::check()) && (Auth::user())){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
 
        
    }
}
