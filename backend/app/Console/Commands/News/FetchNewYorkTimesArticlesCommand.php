<?php

namespace App\Console\Commands\News;

use App\Jobs\NewsSources\NYTimes\FetchAndSaveNewsByCategory;
use App\Models\Category;
use App\Repository\Interfaces\ICategoryRepository;
use Illuminate\Console\Command;

class FetchNewYorkTimesArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch:ny-times';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch articles from New York Times API';

    /**
     * Execute the console command.
     */
    public function handle(ICategoryRepository $categoryRepository): void
    {
        $categories = $categoryRepository->all();
        $categories->each(
            fn (Category $category, int $index) => FetchAndSaveNewsByCategory::class::dispatch($category)->delay(now()->addSeconds($index * 60))
        );
        $this->info('Article fetching from New York Times has been queued, it should take about 11 minutes to complete');
    }
}
