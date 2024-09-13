<?php

namespace App\Http\Controllers\Lookup;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\Category\Interfaces\ICategoryService;

class LookupCategoriesController extends Controller
{
    private ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function __invoke()
    {
        $categories = $this->categoryService->getAllCategories();

        return response()->json([
            'categories' => CategoryResource::collection($categories),
        ]);
    }
}
