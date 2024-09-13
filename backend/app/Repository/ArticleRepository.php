<?php

namespace App\Repository;

use App\Data\DTO\Article\ArticleDTO;
use App\Filters\Article\PublishRangeFilter;
use App\Filters\Article\TextSearchFilter;
use App\Models\Article;
use App\Repository\Interfaces\IArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleRepository implements IArticleRepository
{
    public function firstOrCreate(array $attributes, ?ArticleDTO $dto = null): Article
    {
        $values = $dto ? $dto->toArray() : [];

        return Article::firstOrCreate($attributes, $values);
    }

    /**
     * Get articles by search criteria
     */
    public function getArticles(?string $search, ?array $categories = null, ?array $sources = null, ?array $authors = null): LengthAwarePaginator
    {
        return QueryBuilder::for(Article::class)
            ->with(['category', 'author', 'source'])
            ->allowedFilters([
                AllowedFilter::custom('search', new TextSearchFilter),
                AllowedFilter::exact('category_id')->ignore(null),
                AllowedFilter::exact('author_id')->ignore(null),
                AllowedFilter::exact('source_id')->ignore(null),
                AllowedFilter::custom('range', new PublishRangeFilter),
            ])
            ->paginate();
    }
}
