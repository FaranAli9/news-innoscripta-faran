<?php

namespace App\Data\DTO\Category;

use Spatie\LaravelData\Data;

class CreateCategoryDTO extends Data
{
    /**
     * Create a new class instance.
     */
    public function __construct(public $name) {}
}
