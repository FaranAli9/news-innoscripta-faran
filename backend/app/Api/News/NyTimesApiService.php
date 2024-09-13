<?php

namespace App\Api\News;

use App\Models\Category;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class NyTimesApiService
{
    /**
     * @throws ConnectionException
     */
    public function get(Category $category, int $page): array
    {
        $response = Http::baseUrl(config('news.new-york-times-api.endpoint'))
            ->withQueryParameters([
                'q'       => $category->name,
                'page'    => $page,
                'api-key' => config('news.new-york-times-api.api-key'),
            ])
            ->get('svc/search/v2/articlesearch.json')
            ->json();

        return Arr::get($response, 'response.docs', []);

    }
}
