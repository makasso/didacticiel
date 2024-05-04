<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckProfValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->copy_link) {
            $course = Course::with('user')->where('copy_link', $request->copy_link)->first();
            $prof = $course->user;
            
            $profValidityDate = Carbon::parse($prof->expiry_date);
            $date = Carbon::now();

            if($date->gt($profValidityDate)) {
                toast('Le prof de ce cours n\'est plus autorisé', 'error', 'top-right');
                abort(403);
            }
            
        }
        return $next($request);
    }
}
