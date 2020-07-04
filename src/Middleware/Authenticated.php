<?php

namespace AshleyUpson\LaraCMS\Middleware;

use AshleyUpson\LaraCMS\Models\UserData;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticated
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
        if(Auth::check()) {
            return $next($request);
        }

        if(config('lara-cms.use_cms_authentication') === true) {
            return redirect()->route('laracms::get.auth/login')->with([
                'error' => 'You need to be logged in to access that page.',
                'next' => $request->headers->get('referer')
            ]);
        }
    }
}
