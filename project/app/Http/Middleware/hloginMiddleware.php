<?php

namespace App\Http\Middleware;

use Closure;

class hloginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $uid = session('uid');

        if(!$uid){

            return redirect('/home/index')->with('msg','请先登录,再进行下一步操作!!');
            
        } else {

            return $next($request);
        }
    }
}
