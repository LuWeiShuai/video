<?php

namespace App\Http\Middleware;

use Closure;

class aloginMiddleware
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
         $id = session('id');

        if(!$id){

            return redirect('/admin_login');
        } else {

            return $next($request);
        }
    }
}
