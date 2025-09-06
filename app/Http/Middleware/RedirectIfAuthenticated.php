<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'staff':
                        return redirect()->route('staff.dashboard');
                    case 'account':
                        return redirect()->route('account.dashboard');
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'creator':
                        return redirect()->route('creator.dashboard');
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
