<?php

namespace App\Http\Controllers\Feed;

use App\Data\DTO\FeedPreference\FeedPreferenceDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedPreference\UpdateFeedPreferenceRequest;
use App\Services\FeedPreference\Interfaces\IFeedPreferenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedPreferenceController extends Controller
{
    protected IFeedPreferenceService $feedPreferenceService;

    public function __construct(IFeedPreferenceService $feedPreferenceService)
    {
        $this->feedPreferenceService = $feedPreferenceService;
    }

    public function get(Request $request): JsonResponse
    {
        $user        = $request->user();
        $preferences = $this->feedPreferenceService->getByUser($user);

        return response()->json([
            'preferences' => $preferences,
        ]);
    }

    public function update(UpdateFeedPreferenceRequest $request): JsonResponse
    {
        $user = $request->user();
        $dto  = new FeedPreferenceDTO(
            categories: $request->validated('categories', []),
            authors: $request->validated('authors', []),
            sources: $request->validated('sources', [])
        );

        $preferences = $this->feedPreferenceService->updateByUser($user, $dto);

        return response()->json([
            'preferences' => $preferences,
        ]);
    }
}
