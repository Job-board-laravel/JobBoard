<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJopRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255',
            'description' => 'required',
            'requirement' => 'required',
            'benefit' => 'required',
            'location' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'technologies' => 'required|string',
            'work_type' => 'required|in:remote,onsite,hybrid',
            'salary_range' => 'nullable|numeric',
            'application_deadline' => 'required|date',
            'category_id'=>'required'
        ];
    }
    public function messages(): array{
        return [

            "title.required" =>"Place enter your title and has lehgth 5 or more",
            "description.required" =>"Place enter description!",
            "requirement.required" =>"no Job without requirement!",
            "benefit.required" =>"please Enter the job benefit!",
            "location.required" =>"Enter location Job!",
            "contact_info.required" =>"Enter contact info to conection with candidate!",
            "technologies.required" =>"Enter your technologies that request it!",
            "work_type.required" =>"work_type must be remote, onsite, hybrid!",
            "salary_range.required" =>"enter the salary and must be numrical",
            "application_deadline.required" =>"Enter application_deadline",
            "category_id.required"=>"Please select Catagory Job"


        ];
    }
}
