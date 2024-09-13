<?php

namespace App\Repository\Interfaces;

use App\Data\DTO\Category\CreateCategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface ICategoryRepository
{
    public function all(): Collection;

    public function create(CreateCategoryDTO $dto): Category;
}
