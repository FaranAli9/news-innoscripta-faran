<?php

namespace App\Repository;

use App\Data\DTO\Category\CreateCategoryDTO;
use App\Models\Category;
use App\Repository\Interfaces\ICategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements ICategoryRepository
{
    public function create(CreateCategoryDTO $dto): Category
    {
        return Category::create($dto->toArray());
    }

    public function all(): Collection
    {
        return Category::all();
    }
}
