<?php

namespace App\Api\News;

use App\Models\Category;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class NewsApiService
{
    /**
     * @throws ConnectionException
     */
    public function get(Category $category): array
    {
        $response = Http::baseUrl(config('news.news-api.endpoint'))
            ->withQueryParameters([
                'q'        => $category->name,
                'language' => 'en',
                'pageSize' => 100,
                'page'     => 1,
                'sortBy'   => 'popularity',
                'apiKey'   => config('news.news-api.api-key'),
            ])
            ->get('everything')
            ->json();

        return $response['articles'];
    }
}
