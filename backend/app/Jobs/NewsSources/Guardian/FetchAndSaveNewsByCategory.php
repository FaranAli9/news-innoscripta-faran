<?php

namespace App\Jobs\NewsSources\Guardian;

use App\Api\News\GuardianApiService;
use App\Data\DTO\Article\ArticleDTO;
use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Repository\Interfaces\IArticleRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchAndSaveNewsByCategory implements ShouldQueue
{
    use Queueable;

    private Category $category;

    private Author $author;

    private Source $source;

    /**
     * Create a new job instance.
     */
    public function __construct(Category $category, Author $author, Source $source)
    {
        $this->category = $category;
        $this->author   = $author;
        $this->source   = $source;
    }

    /**
     * Execute the job.
     */
    public function handle(GuardianApiService $guardianApiService, IArticleRepository $articleRepository): void
    {
        $pages = [1, 2, 3];
        foreach ($pages as $page) {
            try {
                $items = $guardianApiService->get($this->category, $page);
                foreach ($items as $item) {
                    $dto = $this->convertGuardianResponseItemToArticleDTO($item);
                    $articleRepository->firstOrCreate(['title' => $dto->title, 'link' => $dto->link], $dto);

                }
            } catch (Exception $exception) {
                Log::error('Error importing news from The News API: '.$exception->getMessage());
            }
        }
    }

    private function convertGuardianResponseItemToArticleDTO(array $item): ArticleDTO
    {
        return new ArticleDTO(
            author_id: $this->author->id,
            source_id: $this->source->id,
            category_id: $this->category->id,
            title: $item['webTitle'],
            link: $item['webUrl'],
            published_at: Carbon::parse($item['webPublicationDate']),
        );
    }
}
