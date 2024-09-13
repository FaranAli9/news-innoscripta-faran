<?php

namespace App\Services\Feed;

use App\Repository\Interfaces\IArticleRepository;
use App\Services\Feed\Interfaces\IFeedService;

class FeedService implements IFeedService
{
    private IArticleRepository $articleRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(IArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getFeedArticles(?string $search)
    {
        return $this->articleRepository->getArticles($search);
    }
}
