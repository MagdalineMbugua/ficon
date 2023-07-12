<?php

namespace App\Http\Controllers;

use App\Enum\Roles;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRoleController extends Controller
{
    public function __invoke(Request $request): UserResource
    {
        $request->validate([
            'role_name' => ['required', Rule::in([Roles::BASIC, Roles::STANDARD, Roles::PREMIUM])]
        ]);

        $user = Auth::user();
        $user->roles()->detach($user->roles);
        $user->assignRole($request->input('role_name'));

        return new UserResource($user->load('roles'));
    }
}
