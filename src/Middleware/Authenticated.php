<?php

namespace LaraCMS\Middleware;

use LaraCMS\Models\UserData;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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
            return redirect()->to((config('lara-cms.use_cms_authentication') === true ? route('laracms::get.auth/login') : config('lara-cms.login_route')))->with([
                'error' => 'You need to be logged in to access that page.',
                'next' => URL::current()
            ]);
        }
    }
}
