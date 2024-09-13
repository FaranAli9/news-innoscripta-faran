<?php

namespace App\Repository\Interfaces;

use App\Data\DTO\User\CreateUserDTO;
use App\Data\DTO\User\UpdateUserDTO;
use App\Models\User;

interface IUserRepository
{
    public function create(CreateUserDTO $dto): User;

    public function update(User $user, UpdateUserDTO $dto): User;
}
