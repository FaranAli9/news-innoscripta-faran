<?php

namespace App\Services\Auth\Interfaces;

use App\Data\DTO\User\CreateUserDTO;
use App\Models\User;

interface IRegisterService
{
    public function register(CreateUserDTO $dto): User;
}
