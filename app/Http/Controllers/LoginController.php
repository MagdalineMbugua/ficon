<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            User::updateOrCreate(
                [
                    'google_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'google_token'=>$user->token,
                    'email_verified_at' => Carbon::now(),
                ]
            );
            Auth::login($user);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
