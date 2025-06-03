<?php

namespace App\Http\Requests\Students;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => 'required|uuid|exists:' . (new User())->getTable() . ',uuid',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'email' => 'required|email|unique:' . (new User)->getTable() . ',email,',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'role' => 'required|in:Excellent,Good,Average,Poor',
        ];
    }
}
