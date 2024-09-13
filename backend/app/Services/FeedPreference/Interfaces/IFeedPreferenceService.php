<?php

namespace App\Services\FeedPreference\Interfaces;

use App\Data\DTO\FeedPreference\FeedPreferenceDTO;
use App\Models\FeedPreference;
use App\Models\User;

interface IFeedPreferenceService
{
    /**
     * Get feed preferences for a specific user.
     */
    public function getByUser(User $user): FeedPreferenceDTO;

    /**
     * Update feed preferences for a specific user.
     */
    public function updateByUser(User $user, FeedPreferenceDTO $dto): FeedPreference;
}
