<?php

namespace App\Http\Controllers\Auth;

use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\JsonResponse;
class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse {

        if(!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'email không tồn tại'
            ]);
        }

        $user = User::where('email', $request['email'])->first();
        $token = $user->createToken('access_token', [TokenAbility::ACCESS_TOKEN->value], Carbon::now()->addMinute(config('sanctum.expiration')))->plainTextToken;
        $refreshToken = $user->createToken('refresh_token', [TokenAbility::REFRESH_TOKEN->value], Carbon::now()->addMinute(config('sanctum.rf_expiration')))->plainTextToken;
        return $this->responseWithToken($token, $refreshToken);
    }
    public function refreshToken(Request $request): JsonResponse
    {
        $tokens = $request->user()->tokens()->where('name', 'access_token')->delete();
        $token = $request->user()->createToken('access_token', [TokenAbility::ACCESS_TOKEN->value], Carbon::now()->addMinute(config('sanctum.expiration')))->plainTextToken;
        $refreshToken = $request->bearerToken();
        $personalToken = PersonalAccessToken::findToken($refreshToken);
        $refreshToken_expiration = Carbon::parse($personalToken->expires_at);

        if(Carbon::now()->diffInHours($refreshToken_expiration) <= 25 ) {
            $personalToken->delete();
            $refreshToken = $request->user()->createToken('refresh_token', [TokenAbility::REFRESH_TOKEN->value], Carbon::now()->addMinute(config('sanctum.rf_expiration')))->plainTextToken;
        }
        return $this->responseWithToken($token, $refreshToken);

    }

    public function register(RegisterRequest $request): JsonResponse
    {
//        return $this->sendResponse($request->all());
        $user = User::create($request->all());
        $token = $user->createToken('access_token', [TokenAbility::ACCESS_TOKEN->value], Carbon::now()->addMinute(config('sanctum.expiration')))->plainTextToken;
        $refreshToken = $user->createToken('refresh_token', [TokenAbility::REFRESH_TOKEN->value], Carbon::now()->addMinute(config('sanctum.rf_expiration')))->plainTextToken;
        return $this->responseWithToken($token, $refreshToken);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout Successfully'
        ]);
    }
    private function responseWithToken($token,$refreshToken): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'Bearer',
        ]);
    }
}
