<?php

namespace AshleyUpson\LaraCMS\Middleware;

use AshleyUpson\LaraCMS\Models\UserData;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserIsAdmin
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
        $data = UserData::where('user_id', Auth::user()->id)->first();

        if($data->is_admin === true) {
            return $next($request);
        }

        return redirect()->back()->with([
            'error' => 'You do not have access to that page'
        ]);
    }
}
