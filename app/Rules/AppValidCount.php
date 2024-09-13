<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class AppValidCount implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $user = Auth::user();

        if($user->UserApp()->where('user_id', $user->user_id)->count() > 0){
            // dd("ddd");
            $fail("You have already applied for this job.");
        }
    }
}
