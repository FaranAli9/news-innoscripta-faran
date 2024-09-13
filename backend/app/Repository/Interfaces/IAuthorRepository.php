<?php

namespace App\Repository\Interfaces;

use App\Data\DTO\Author\AuthorDTO;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

interface IAuthorRepository
{
    public function all(): Collection;

    public function firstOrCreate(array $attributes, ?AuthorDTO $dto = null): Author;
}
