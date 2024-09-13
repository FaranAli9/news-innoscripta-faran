<?php

namespace App\Filters\Article;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class PublishRangeFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property): Builder
    {

        if (is_array($value) && count($value) === 2) {
            $query->whereBetween('published_at', $value);
        }

        return $query;
    }
}
