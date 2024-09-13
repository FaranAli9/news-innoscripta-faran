<?php

namespace App\Repository;

use App\Data\DTO\User\CreateUserDTO;
use App\Data\DTO\User\UpdateUserDTO;
use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function create(CreateUserDTO $dto): User
    {
        return User::create([
            'name'     => $dto->name,
            'email'    => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

    }

    public function update(User $user, UpdateUserDTO $dto): User
    {
        $user->name  = $dto->name  ?? $user->name;
        $user->email = $dto->email ?? $user->email;
        if ($dto->password) {
            $user->password = Hash::make($dto->password);
        }
        $user->save();
        $user->refresh();

        return $user;
    }
}
