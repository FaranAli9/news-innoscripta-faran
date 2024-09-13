<?php

namespace App\Repository;

use App\Data\DTO\FeedPreference\FeedPreferenceDTO;
use App\Models\FeedPreference;
use App\Repository\Interfaces\IFeedPreferenceRepository;
use Exception;

class FeedPreferenceRepository implements IFeedPreferenceRepository
{
    /**
     * @throws Exception
     */
    public function create(int $userId, FeedPreferenceDTO $dto): FeedPreference
    {
        if (FeedPreference::query()->where('user_id', $userId)->exists()) {
            throw new Exception('FeedPreference already exists for user ID:'.$userId);
        }

        return FeedPreference::create([
            'user_id' => $userId,
            ...$dto->toArray(),
        ]);
    }

    public function getByUserId(int $userId): FeedPreference
    {
        return FeedPreference::where('user_id', $userId)->first();
    }

    /**
     * Update feed preferences by user ID.
     */
    public function updateByUserId(int $userId, FeedPreferenceDTO $dto): FeedPreference
    {
        return FeedPreference::updateOrCreate(
            ['user_id' => $userId],
            $dto->toArray()
        );
    }
}
