<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Feed\FeedController;
use App\Http\Controllers\Feed\FeedPreferenceController;
use App\Http\Controllers\Lookup\LookupAuthorsController;
use App\Http\Controllers\Lookup\LookupCategoriesController;
use App\Http\Controllers\Lookup\LookupSourcesController;
use Illuminate\Support\Facades\Route;
use Tighten\Ziggy\Ziggy;

Route::get('ziggy', fn () => response()->json(new Ziggy));

Route::group(['middleware' => 'guest:api', 'prefix' => 'auth'], function () {
    Route::post('register', RegisterController::class)->name('auth.register');
    Route::post('login', LoginController::class)->name('auth.login');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('profile', [ProfileController::class, 'get'])->name('auth.profile.get');
        Route::post('profile', [ProfileController::class, 'post'])->name('auth.profile.update');
    });

    Route::get('feed', [FeedController::class, 'index'])->name('feed.index');
    Route::get('feed/preferences', [FeedPreferenceController::class, 'get'])->name('feed.preferences.get');
    Route::post('feed/preferences', [FeedPreferenceController::class, 'update'])->name('feed.preferences.update');

    Route::group(['prefix' => 'lookups'], function () {
        Route::get('categories', LookupCategoriesController::class)->name('lookups.categories');
        Route::get('sources', LookupSourcesController::class)->name('lookups.sources');
        Route::get('authors', LookupAuthorsController::class)->name('lookups.authors');
    });
});
