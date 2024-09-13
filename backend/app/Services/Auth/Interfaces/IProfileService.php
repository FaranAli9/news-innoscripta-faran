<?php

namespace App\Services\Auth\Interfaces;

use App\Data\DTO\User\UpdateUserDTO;
use App\Models\User;

interface IProfileService
{
    public function getProfile(): User;

    public function updateProfile(UpdateUserDTO $dto): User;
}
