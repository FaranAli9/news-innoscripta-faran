<?php

namespace App\Repository\Interfaces;

use App\Data\DTO\FeedPreference\FeedPreferenceDTO;
use App\Models\FeedPreference;

interface IFeedPreferenceRepository
{
    public function create(int $userId, FeedPreferenceDTO $dto): FeedPreference;

    public function getByUserId(int $userId): FeedPreference;

    public function updateByUserId(int $userId, FeedPreferenceDTO $dto): FeedPreference;
}
