<?php

namespace App\Jobs\NewsSources\NewsApi;

use App\Api\News\NewsApiService;
use App\Data\DTO\Article\ArticleDTO;
use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Repository\Interfaces\IArticleRepository;
use App\Repository\Interfaces\IAuthorRepository;
use App\Repository\Interfaces\ISourceRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchAndSaveNewsByCategory implements ShouldQueue
{
    use Queueable;

    private const PAGES_PER_CATEGORY = 5;

    private Category $category;

    /**
     * Create a new job instance.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     */
    public function handle(
        NewsApiService $newsApiService,
        IArticleRepository $articleRepository,
        IAuthorRepository $authorRepository,
        ISourceRepository $sourceRepository
    ): void {

        try {
            $items = $newsApiService->get($this->category);
            foreach ($items as $item) {

                $authorName = $item['author'] ?? $item['source']['name'];

                $author = $authorRepository->firstOrCreate(['name' => $authorName]);

                $source = $sourceRepository->firstOrCreate(['name' => $item['source']['name']]);

                $dto = $this->convertGuardianResponseItemToArticleDTO($item, $this->category, $author, $source);
                $articleRepository->firstOrCreate([
                    'title' => $dto->title,
                    'link'  => $dto->link,
                ], $dto);
            }
        } catch (Exception $exception) {
            Log::error('Could not get articles from News API. Exception: '.$exception->getMessage());

        }

    }

    private function convertGuardianResponseItemToArticleDTO(array $item, Category $category, Author $author, Source $source): ArticleDTO
    {
        return new ArticleDTO(
            author_id: $author->id,
            source_id: $source->id,
            category_id: $category->id,
            title: $item['title'],
            link: $item['url'],
            published_at: Carbon::parse($item['publishedAt']),
            summary: $item['description'],
            image: $item['urlToImage']
        );
    }
}
