<?php

namespace App\Services\Auth\Interfaces;

interface IJWTService
{
    public function generateToken(array $credentials): string;
}
