<?php

namespace App\Jobs\NewsSources\NYTimes;

use App\Api\News\NyTimesApiService;
use App\Data\DTO\Article\ArticleDTO;
use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Repository\Interfaces\IArticleRepository;
use App\Repository\Interfaces\IAuthorRepository;
use App\Repository\Interfaces\ISourceRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        NyTimesApiService $nyTimesApiService,
        IArticleRepository $articleRepository,
        IAuthorRepository $authorRepository,
        ISourceRepository $sourceRepository
    ): void {
        for ($i = 1; $i <= self::PAGES_PER_CATEGORY; $i++) {
            try {
                $items = $nyTimesApiService->get($this->category, $i);
                foreach ($items as $item) {

                    $authorName = Str::remove('By ', $item['byline']['original'], false);

                    $author = $authorRepository->firstOrCreate(['name' => $authorName]);

                    $source = $sourceRepository->firstOrCreate(['name' => $item['source']]);

                    $dto = $this->convertGuardianResponseItemToArticleDTO($item, $this->category, $author, $source);
                    $articleRepository->firstOrCreate([
                        'title' => $dto->title,
                        'link'  => $dto->link,
                    ], $dto);
                }
                sleep(8); // NYTimes API rate limit is 5 reqs per minute, this is to divide the 5 reqs over a minute. Can be refactored to use Job Middleware with proper rate limits
            } catch (ConnectionException $e) {
                Log::error('Error fetching data from NYTimes API: '.$e->getMessage());
            }
        }
    }

    private function convertGuardianResponseItemToArticleDTO(array $item, Category $category, Author $author, Source $source): ArticleDTO
    {
        return new ArticleDTO(
            author_id: $author->id,
            source_id: $source->id,
            category_id: $category->id,
            title: Arr::get($item, 'headline.main'),
            link: Arr::get($item, 'web_url'),
            published_at: Carbon::parse($item['pub_date']),
            summary: Arr::get($item, 'lead_paragraph'),
            image: Arr::get($item, 'multimedia.0.url') ? 'https://www.nytimes.com/'.Arr::get($item, 'multimedia.0.url') : null
        );
    }
}
