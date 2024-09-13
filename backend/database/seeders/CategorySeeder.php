<?php

namespace Database\Seeders;

use App\Data\DTO\Category\CreateCategoryDTO;
use App\Repository\CategoryRepository;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CategoryRepository $categoryRepository): void
    {
        $categories = ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology'];
        foreach ($categories as $category) {
            $categoryRepository->create(new CreateCategoryDTO($category));
        }
    }
}
