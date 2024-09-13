<?php

namespace App\Console\Commands\News;

use App\Jobs\NewsSources\NewsApi\FetchAndSaveNewsByCategory;
use App\Models\Category;
use App\Repository\Interfaces\ICategoryRepository;
use Illuminate\Console\Command;

class FetchNewsApiArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch:news-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch articles from News API';

    /**
     * Execute the console command.
     */
    public function handle(ICategoryRepository $categoryRepository): void
    {
        $categories = $categoryRepository->all();
        $categories->each(fn (Category $category) => FetchAndSaveNewsByCategory::dispatch($category));
        $this->info('Article fetching from News API has been queued. It should take less than 1 minute');
    }
}
