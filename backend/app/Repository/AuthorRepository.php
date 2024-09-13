<?php

namespace App\Repository;

use App\Data\DTO\Author\AuthorDTO;
use App\Models\Author;
use App\Repository\Interfaces\IAuthorRepository;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository implements IAuthorRepository
{
    public function all(): Collection
    {
        return Author::all();
    }

    public function firstOrCreate(array $attributes, ?AuthorDTO $dto = null): Author
    {
        $values = $dto ? $dto->toArray() : [];

        return Author::firstOrCreate($attributes, $values);
    }
}
