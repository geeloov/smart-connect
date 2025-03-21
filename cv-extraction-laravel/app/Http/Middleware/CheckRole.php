<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }
            
            // Redirect to appropriate dashboard based on user role
            if ($request->user() && $request->user()->role === 'recruiter') {
                return redirect()->route('recruiter.dashboard');
            } elseif ($request->user() && $request->user()->role === 'job_seeker') {
                return redirect()->route('job-seeker.dashboard');
            }
            
            return redirect()->route('login');
        }

        return $next($request);
    }
}
