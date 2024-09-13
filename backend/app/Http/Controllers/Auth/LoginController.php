<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Interfaces\IJWTService;

class LoginController extends Controller
{
    private IJWTService $jwtService;

    public function __construct(IJWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function __invoke(LoginRequest $request)
    {
        $token = $this->jwtService->generateToken([
            'email'    => $request->validated('email'),
            'password' => $request->validated('password'),
        ]);

        return response()->json(compact('token'));
    }
}
