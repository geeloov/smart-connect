<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect to appropriate dashboard based on user role
                $user = Auth::guard($guard)->user();
                
                if ($user->role === 'recruiter') {
                    return redirect()->route('recruiter.dashboard');
                } elseif ($user->role === 'job_seeker') {
                    return redirect()->route('job-seeker.dashboard');
                }
                
                // Fallback to home route
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
} 