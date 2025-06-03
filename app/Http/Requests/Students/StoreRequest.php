<?php

namespace App\Http\Requests\Students;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'email' => 'required|email|unique:' . (new User)->getTable() . ',email,',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'required|in:Excellent,Good,Average,Poor',
            'count' => 'nullable|integer|min:1|max:100',
        ];
    }

    public function storeUser()
    {
        return User::create([
            'uuid' => (string) Str::uuid(),
            'name' => $this->name,
            'description' => $this->description,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);
    }
}
