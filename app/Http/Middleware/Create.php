<?php

namespace App\Http\Middleware;

use Closure;

class Create
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

        $a=0;
        if($a) {
            return $next($request);
        }

        return redirect('/403.php');

    }
}
