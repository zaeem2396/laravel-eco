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
        $customURL = $_SERVER['HTTP_HOST'] . '/';
        // Get the base URL
        $baseUrl = $request->getSchemeAndHttpHost() . '/';

        if (strpos($baseUrl, 'http://') === 0) {
            // URL starts with "http", so remove it
            $baseUrl = str_replace('http://', '', $baseUrl);
        } elseif (strpos($baseUrl, 'https://') === 0) {
            // URL starts with "https", so remove it
            $baseUrl = str_replace('https://', '', $baseUrl);
        }
 
        if ($baseUrl === $customURL) {
            return $next($request);
        }

        return response('Unauthorized', 401);
    }
}
