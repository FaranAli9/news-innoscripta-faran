<?php

namespace App\Data\DTO\Article;

use DateTimeInterface;
use Spatie\LaravelData\Data;

class ArticleDTO extends Data
{
    public function __construct(
        public int $author_id,
        public int $source_id,
        public int $category_id,
        public string $title,
        public string $link,
        public DateTimeInterface $published_at,
        public ?string $summary = null,
        public ?string $image = null,
    ) {}
}
