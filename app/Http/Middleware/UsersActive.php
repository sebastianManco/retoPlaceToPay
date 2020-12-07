<?php

namespace App\Http\Middleware;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Closure;

class UsersActive
{
    /**
     * @param $request
     * @param Closure $next
     * @return RedirectResponse
     */
    public function handle($request, Closure $next): RedirectResponse
    {
        if ($request->user()->estado == 1) {
            return $next($request);
        } else {
            Auth::logout() ;
            return redirect('login');
        }
    }
}
