<?php

namespace App\Traits;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
trait LoginTrait{

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(string $email, int $max_attempts): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($email), $max_attempts)) {
            return;
        }

        //event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey($email));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(string $email): string
    {
        return Str::transliterate(Str::lower($email).'|'.$this->ip());
    }
}