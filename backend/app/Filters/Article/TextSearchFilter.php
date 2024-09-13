<?php

namespace App\Filters\Article;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TextSearchFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property)
    {
        return $query->where(function (Builder $query) use ($value) {
            $query->whereRaw("LOWER(`articles`.`title`) LIKE '%$value%'")
                ->orWhereRaw("LOWER(`articles`.`summary`) LIKE '%$value%'");
        });
    }
}
