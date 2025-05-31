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
        // First check if user is authenticated
        if (!$request->user()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login');
        }
        
        // Then check if user has the correct role
        if ($request->user()->role !== $role) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Insufficient permissions.'], 403);
            }
            
            // Redirect to appropriate dashboard based on user's actual role
            if ($request->user()->role === 'recruiter') {
                return redirect()->route('recruiter.dashboard')
                    ->with('error', 'You do not have permission to access that page.');
            } elseif ($request->user()->role === 'job_seeker') {
                return redirect()->route('job-seeker.dashboard')
                    ->with('error', 'You do not have permission to access that page.');
            }
            
            return redirect()->route('home')
                ->with('error', 'You do not have permission to access that page.');
        }

        return $next($request);
    }
}
