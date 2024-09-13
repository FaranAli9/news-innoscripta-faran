<?php

namespace App\Services\Auth;

use App\Data\DTO\User\UpdateUserDTO;
use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use App\Services\Auth\Interfaces\IProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileService implements IProfileService
{
    private const GUARD = 'api';

    private User $user;

    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->user           = Auth::guard(self::GUARD)->user();
        $this->userRepository = $userRepository;
    }

    public function getProfile(): User
    {
        return $this->user;
    }

    public function updateProfile(UpdateUserDTO $dto): User
    {
        return $this->userRepository->update($this->user, $dto);
    }
}
