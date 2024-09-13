<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Services\Feed\Interfaces\IFeedService;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    private IFeedService $feedService;

    public function __construct(IFeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    public function index(Request $request)
    {
        $search     = $request->get('search');
        $categories = $request->get('categories');
        $sources    = $request->get('sources');
        $authors    = $request->get('authors');
        $range      = $request->get('range');

        $articles = $this->feedService->getFeedArticles($search);

        return response()->json([
            'articles' => $articles,
        ]);
    }
}
