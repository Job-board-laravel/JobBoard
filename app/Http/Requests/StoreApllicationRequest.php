<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApllicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'cover_letter' => 'required|string'
        ];
    }
    public function messages(): array{
        return [
            "name.required"  => "Please enter your Name and has lehgth 5 or more",
            "email.required" => "Please enter a vilad email!",
            "phone.required" => "Please enter a valid number and only number!",
            "cover_letter.required" => "Please Enter Cover letter!"
        ];
    }

}
