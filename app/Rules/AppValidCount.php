<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Rules\AppValidCount;

class AppValidCount implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();
        if ($user) {
            // Correct use of relationship and ID field
            $applicationCount = $user->UserApp()->count();
            if ($applicationCount >= 1) {
                $fail('You have already applied for this job.');
            }
        }
    }
}
