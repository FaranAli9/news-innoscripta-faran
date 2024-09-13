<?php

namespace App\Data\DTO\Source;

use Spatie\LaravelData\Data;

class SourceDTO extends Data
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name
    ) {}
}
