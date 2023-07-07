<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googleCallback(): JsonResponse
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user=User::updateOrCreate(
                [
                    'google_id' => (string) $googleUser->id,],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => Carbon::now()->toDateString(),
                ]
            );

            Auth::login($user);
           $tokenResult= $user->createToken('Personal Access Token');

            return response()->json([
                'access_token'=> $tokenResult->plainTextToken,
                'expires_at'=>Carbon::parse($tokenResult->accessToken->expires_at)->toDateTimeString(),
                'user'=> new UserResource($user),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'=> $e->getMessage()
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
