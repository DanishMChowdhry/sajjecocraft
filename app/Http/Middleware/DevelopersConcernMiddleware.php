<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DeveloperConcern;

class DevelopersConcernMiddleware
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
        $concern = DeveloperConcern::find(1);

        if ($concern->enableMode === 'true') {
            // Proceed with the request if enableMode is "true"
            return $next($request);
        }

        // If enableMode is not "true" or the record does not exist, echo the msg
        return response()->json(['message' => $concern ? $concern->msg : 'Developer concern record not found.'], 403);
    }
}
