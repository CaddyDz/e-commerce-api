<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'bail|required|string|min:3|max:50',
            'last_name' => 'bail|required|string|min:3|max:50',
            'email' => 'bail|required|email:rfc,dns',
            'password' => 'bail|required|string|confirmed',
            'avatar' => 'bail|required',
            'address' => 'bail|required',
            'phone_number' => 'bail|required',
        ];
    }
}
