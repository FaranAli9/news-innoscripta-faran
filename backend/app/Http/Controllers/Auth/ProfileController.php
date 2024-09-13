<?php

namespace App\Http\Controllers\Auth;

use App\Data\DTO\User\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\Interfaces\IProfileService;

class ProfileController extends Controller
{
    private IProfileService $profileService;

    public function __construct(IProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function get()
    {
        $user = $this->profileService->getProfile();

        return response()->json([
            'user' => new UserResource($user),
        ]);
    }

    public function post(UpdateProfileRequest $request)
    {
        $dto = new UpdateUserDTO(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password')
        );
        $user = $this->profileService->updateProfile($dto);

        return response()->json([
            'user' => new UserResource($user),
        ]);
    }
}
