<?php

namespace App\Services\Feed\Interfaces;

interface IFeedService
{
    public function getFeedArticles(?string $search);
}
