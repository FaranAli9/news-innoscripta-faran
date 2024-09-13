<?php

namespace App\Providers;

use App\Services\Auth\Interfaces\IJWTService;
use App\Services\Auth\Interfaces\IProfileService;
use App\Services\Auth\Interfaces\IRegisterService;
use App\Services\Auth\JWTService;
use App\Services\Auth\ProfileService;
use App\Services\Auth\RegisterService;
use App\Services\Author\AuthorService;
use App\Services\Author\Interfaces\IAuthorService;
use App\Services\Category\CategoryService;
use App\Services\Category\Interfaces\ICategoryService;
use App\Services\Feed\FeedService;
use App\Services\Feed\Interfaces\IFeedService;
use App\Services\FeedPreference\FeedPreferenceService;
use App\Services\FeedPreference\Interfaces\IFeedPreferenceService;
use App\Services\Source\Interfaces\ISourceService;
use App\Services\Source\SourceService;
use Illuminate\Support\ServiceProvider;

class ServiceRegistryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IRegisterService::class, RegisterService::class);
        $this->app->bind(IJWTService::class, JWTService::class);
        $this->app->bind(IProfileService::class, ProfileService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(ISourceService::class, SourceService::class);
        $this->app->bind(IAuthorService::class, AuthorService::class);
        $this->app->bind(IFeedService::class, FeedService::class);
        $this->app->bind(IFeedPreferenceService::class, FeedPreferenceService::class);
    }

    public function boot()
    {
        //
    }
}
