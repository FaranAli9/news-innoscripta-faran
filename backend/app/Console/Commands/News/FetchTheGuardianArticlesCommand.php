<?php

namespace App\Console\Commands\News;

use App\Jobs\NewsSources\Guardian\FetchAndSaveNewsByCategory;
use App\Models\Category;
use App\Repository\Interfaces\IAuthorRepository;
use App\Repository\Interfaces\ICategoryRepository;
use App\Repository\Interfaces\ISourceRepository;
use Illuminate\Console\Command;

class FetchTheGuardianArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch:guardian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch articles from News API';

    /**
     * Execute the console command.
     */
    public function handle(
        ICategoryRepository $categoryRepository,
        IAuthorRepository $authorRepository,
        ISourceRepository $sourceRepository
    ): void {
        $author     = $authorRepository->firstOrCreate(['name' => 'The News']);
        $source     = $sourceRepository->firstOrCreate(['name' => 'The News']);
        $categories = $categoryRepository->all();
        $categories->each(fn (Category $category) => FetchAndSaveNewsByCategory::dispatch($category, $author, $source));
        $this->info('Article fetching from The News has been queued. It should take less than 1 minute');
    }
}
