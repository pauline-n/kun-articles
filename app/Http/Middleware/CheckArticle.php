<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckArticle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        echo 'check middleware';
        // if($request->age<10){
            // echo "age is below 10";
            // return redirect('/');
        // }

        // return $next($request);
    }
}
