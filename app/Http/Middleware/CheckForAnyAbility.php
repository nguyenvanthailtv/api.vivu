<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;
class CheckForAnyAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$abilities): Response
    {
        $token = $request->bearerToken();
        $accessToken = PersonalAccessToken::findToken($token);
//        return response()->json(['m'=> $accessToken->can('refresh')]);
        foreach ($abilities as $ability) {
            if ($accessToken->can($ability)) {
                return $next($request);
            }
        }
        return response()->json(['message' => 'Forbidden'], 403);
    }
}
