<?php

namespace App\Rules;

use App\Models\Meet;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class UsersAvailable implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = Carbon::createFromFormat('Y-m-d', request()?->input('start_time'))->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', request()?->input('start_time'))->addDay()->endOfDay();

        /** @var Meet $meet */
        $meet = Meet::query()->whereBetween('start_time', [$startDate, $endDate])->first();

        if (! $meet) {
            return;
        }

        $attachedUsers = $meet->users->map(static function(User $user) use ($value) {
            if (in_array($user->id, $value, true)) {
                return $user;
            }
        })->filter();

        if (count($attachedUsers) > 0) {
            $fail("User {$attachedUsers->first()->name} with email: {$attachedUsers->first()->email} already has a meet in this schedule");
        }
    }
}
