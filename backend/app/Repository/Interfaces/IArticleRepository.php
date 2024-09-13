<?php

namespace App\Repository\Interfaces;

use App\Data\DTO\Article\ArticleDTO;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IArticleRepository
{
    public function firstOrCreate(array $attributes, ?ArticleDTO $dto = null): Article;

    public function getArticles(?string $search, ?array $categories = null, ?array $sources = null, ?array $authors = null): LengthAwarePaginator;
}
