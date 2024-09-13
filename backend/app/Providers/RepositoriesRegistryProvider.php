<?php

namespace App\Providers;

use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use App\Repository\CategoryRepository;
use App\Repository\FeedPreferenceRepository;
use App\Repository\Interfaces\IArticleRepository;
use App\Repository\Interfaces\IAuthorRepository;
use App\Repository\Interfaces\ICategoryRepository;
use App\Repository\Interfaces\IFeedPreferenceRepository;
use App\Repository\Interfaces\ISourceRepository;
use App\Repository\Interfaces\IUserRepository;
use App\Repository\SourceRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesRegistryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ISourceRepository::class, SourceRepository::class);
        $this->app->bind(IAuthorRepository::class, AuthorRepository::class);
        $this->app->bind(IArticleRepository::class, ArticleRepository::class);
        $this->app->bind(IFeedPreferenceRepository::class, FeedPreferenceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
