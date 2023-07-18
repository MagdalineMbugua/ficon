<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $role=Role::findByName($this->user()->getRoleNames()[0]);
        return $role->hasPermissionTo('create_post');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'caption' => ['required', 'string'],
            'on_sale' => ['required', 'string'],
            'media'=>['required', 'array'],
            'media.*.file'=>['required', 'file','mimes:jpeg,png,jpg,avi,mpeg,quicktime,mp4'],
        ];
    }
}
