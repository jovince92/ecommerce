<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addSeconds(30); // keep online for 1 min
            Cache::put('user-is-online'.Auth::user()->id,true,$expiresAt);

            // last seen
            User::where('id', Auth::user()->id)->update(['last_seen' =>now()]);
        }

        return $next($request);
    }
}
