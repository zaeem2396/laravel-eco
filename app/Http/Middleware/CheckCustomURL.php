<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCustomURL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $customURL = $_SERVER['HTTP_HOST'].'/';
        // Get the base URL without any additional segments.
        $baseUrl = str_replace('http://', '', $request->getSchemeAndHttpHost() . '/');
        if ($baseUrl === $customURL) {
            return $next($request);
        }

        return response('Unauthorized', 401);
    }
}
