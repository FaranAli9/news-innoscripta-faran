<?php

namespace App\Services\Category;

use App\Repository\Interfaces\ICategoryRepository;
use App\Services\Category\Interfaces\ICategoryService;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements ICategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->all();
    }
}
