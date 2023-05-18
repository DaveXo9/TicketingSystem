<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'email' => ['required', 'email'],
        ];
        if ($this->has('name')) {
            $rules['name'] = ['required', 'min:3'];
        }

        if ($this->has('password')) {
            $rules['password'] = 'required|min:8';
        }

        return $rules;
    }
}
