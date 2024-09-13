<?php

namespace App\Services\FeedPreference;

use App\Data\DTO\FeedPreference\FeedPreferenceDTO;
use App\Models\FeedPreference;
use App\Models\User;
use App\Repository\Interfaces\IFeedPreferenceRepository;
use App\Services\FeedPreference\Interfaces\IFeedPreferenceService;

class FeedPreferenceService implements IFeedPreferenceService
{
    protected IFeedPreferenceRepository $feedPreferenceRepository;

    public function __construct(IFeedPreferenceRepository $feedPreferenceRepository)
    {
        $this->feedPreferenceRepository = $feedPreferenceRepository;
    }

    /**
     * Get feed preferences for a specific user.
     */
    public function getByUser(User $user): FeedPreferenceDTO
    {
        $feedPreference = $this->feedPreferenceRepository->getByUserId($user->id);

        return new FeedPreferenceDTO(
            categories: $feedPreference->categories,
            authors: $feedPreference->authors,
            sources: $feedPreference->sources
        );
    }

    /**
     * Update feed preferences for a specific user.
     */
    public function updateByUser(User $user, FeedPreferenceDTO $dto): FeedPreference
    {
        return $this->feedPreferenceRepository->updateByUserId($user->id, $dto);
    }
}
