<?php

namespace App\Services\Auth;

use App\Services\Auth\Interfaces\IJWTService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class JWTService implements IJWTService
{
    private const GUARD_NAME = 'api';

    private const IDENTIFIER_KEY = 'email';

    public function generateToken(array $credentials): string
    {
        if (! $token = Auth::guard(self::GUARD_NAME)->attempt($credentials)) {
            throw ValidationException::withMessages([
                self::IDENTIFIER_KEY => 'The provided credentials do not match our records.',
            ]);
        }

        return $token;
    }
}
