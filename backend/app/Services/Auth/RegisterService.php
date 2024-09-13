<?php

namespace App\Services\Auth;

use App\Data\DTO\User\CreateUserDTO;
use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use App\Services\Auth\Interfaces\IRegisterService;

class RegisterService implements IRegisterService
{
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(CreateUserDTO $dto): User
    {
        return $this->userRepository->create($dto);
    }
}
