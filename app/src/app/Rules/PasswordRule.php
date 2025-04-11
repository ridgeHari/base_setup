<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    const MIN_LENGTH = 15;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) < self::MIN_LENGTH) {
            $fail(":attribute は最低 " . self::MIN_LENGTH . " 文字でなければなりません。");
        }

        if (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[\W_])[a-zA-Z0-9\W_]+$/', $value)) {
            $fail(":attribute はアルファベット、数字、特殊文字を含んでいる必要があります。");
        }
    }
}
