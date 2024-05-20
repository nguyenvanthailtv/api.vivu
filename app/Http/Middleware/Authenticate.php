<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if(Carbon::parse($accessToken->expires_at) < Carbon::now()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!$accessToken || !$accessToken->tokenable) {
            return response()->json(['message' => 'Unauthorized or invalid token'], 401);
        }

        Auth::setUser($accessToken->tokenable);
        return $next($request);
    }
}
