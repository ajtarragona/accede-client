<?php

namespace Ajtarragona\Accede\Middlewares;

use Closure;

class AccedeBackend
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
    	if (!config("accede.backend")) {
    		 $error=__("Oops! Accede backend is disabled");
    		 return view("accede-client::erroraccede",compact('error'));
        }

        return $next($request);
    }
}