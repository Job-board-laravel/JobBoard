<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AppValidCount;

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
            'name' => ['required','string','min:5','max:255'],// new AppValidCount
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'cover_letter' => 'required|string',
        ];
    }
    public function messages(): array{
        return [
            "name.required"  => "Please enter your Name and has lehgth 5 or more",
            "email.required" => "Please enter a vilad email!",
            "phone.required" => "Please enter a valid number and only number!",
            "cover_letter.required" => "Please Enter Cover letter!",
            'job_application.required'=>''
        ];
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function failedValidation(Validator $validator)
    // {
    //     // Redirect to the desired page with error messages
    //     throw new ValidationException($validator, redirect()->route('application.index')
    //         ->withErrors($validator)
    //         ->withInput()
    //         ->with('applied', 'You have already applied for this job.'));
    // }
}
