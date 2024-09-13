<?php

namespace App\Data\DTO\User;

class CreateUserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self($data['name'], $data['email'], $data['password']);
    }
}
