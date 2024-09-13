<?php

namespace App\Data\DTO\Author;

use Spatie\LaravelData\Data;

class AuthorDTO extends Data
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name
    ) {}
}
