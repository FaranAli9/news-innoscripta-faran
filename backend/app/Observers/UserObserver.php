<?php

namespace App\Observers;

use App\Data\DTO\FeedPreference\FeedPreferenceDTO;
use App\Models\User;
use App\Repository\Interfaces\IFeedPreferenceRepository;

class UserObserver
{
    private IFeedPreferenceRepository $feedPreferenceRepository;

    public function __construct(IFeedPreferenceRepository $feedPreferenceRepository)
    {
        $this->feedPreferenceRepository = $feedPreferenceRepository;
    }

    public function created(User $user): void
    {
        $dto = new FeedPreferenceDTO(categories: [], authors: [], sources: []);
        $this->feedPreferenceRepository->create($user->id, $dto);
    }
}
