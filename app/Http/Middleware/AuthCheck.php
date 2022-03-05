<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        if(!session()->has('logged') && ($request->path() != 'auth' && $request->path() != 'register')){
            return redirect()->route('auth.index')->with('msg',__('cms.login'));
        }

        if(session()->has('logged') && ($request->path() == 'auth' || $request->path() == 'register')){
            return redirect()->route('index');
        }
        return $next($request);
    }
}
