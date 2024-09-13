<?php

namespace App\Data\DTO\FeedPreference;

use Spatie\LaravelData\Data;

class FeedPreferenceDTO extends Data
{
    public function __construct(
        public array $categories,
        public array $authors,
        public array $sources,
    ) {}
}
