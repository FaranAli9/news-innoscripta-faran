<?php

namespace App\Api\News;

use App\Models\Category;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GuardianApiService
{
    /**
     * @throws ConnectionException
     */
    public function get(Category $category, int $page): array
    {
        $response = Http::baseUrl(config('news.guardian-api.endpoint'))
            ->withQueryParameters([
                'q'         => $category->name,
                'lang'      => 'en',
                'page-size' => 50,
                'page'      => $page,
                'api-key'   => config('news.guardian-api.api-key'),
            ])
            ->get('search')
            ->json();

        return $response['response']['results'];
    }
}
