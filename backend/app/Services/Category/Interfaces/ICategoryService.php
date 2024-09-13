<?php

namespace App\Services\Category\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ICategoryService
{
    public function getAllCategories(): Collection;
}
