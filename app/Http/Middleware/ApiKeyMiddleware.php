<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-Api-Key');

        if ($apiKey !== 'thbappy1122') {
            return response()->json(['message' => 'Invalid API key'], 401);
        }

        $response = $next($request);

        $response->header('X-Api-Key', $apiKey);

        return $response;
    }
}
