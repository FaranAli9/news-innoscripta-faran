<?php

namespace App\Http\Controllers\Auth;

use App\Data\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\Interfaces\IJWTService;
use App\Services\Auth\Interfaces\IRegisterService;

class RegisterController extends Controller
{
    private IRegisterService $registerService;

    private IJWTService $jwtService;

    public function __construct(IRegisterService $registerService, IJWTService $jwtService)
    {
        $this->registerService = $registerService;
        $this->jwtService      = $jwtService;
    }

    public function __invoke(RegisterRequest $request)
    {
        $dto = CreateUserDTO::fromRequest($request->validated());

        $user = $this->registerService->register($dto);

        $token = $this->jwtService->generateToken([
            'email'    => $dto->email,
            'password' => $dto->password,
        ]);

        return response()->json([
            'user'  => new UserResource($user),
            'token' => $token,
        ], 201);
    }
}
