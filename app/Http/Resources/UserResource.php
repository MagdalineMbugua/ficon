<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'google_id' => $this->google_id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'remember_token' => $this->remember_token,
            'email_verified_at' => $this->email_verified_at,
            'last_login_at' => $this->last_login_at,
            'role' => $this->whenLoaded('roles'),
        ];
    }
}
