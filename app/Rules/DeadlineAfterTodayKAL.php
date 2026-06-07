<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class DeadlineAfterTodayKAL implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (! $value) {
            return true;
        }

        return Carbon::parse($value)->startOfDay()->greaterThanOrEqualTo(today());
    }

    public function message(): string
    {
        return 'The deadline must be today or a future date.';
    }
}
