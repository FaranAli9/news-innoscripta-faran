<?php

namespace App\Services\Source;

use App\Repository\Interfaces\ISourceRepository;
use App\Services\Source\Interfaces\ISourceService;
use Illuminate\Database\Eloquent\Collection;

class SourceService implements ISourceService
{
    protected ISourceRepository $sourceRepository;

    public function __construct(ISourceRepository $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    public function getAllSources(): Collection
    {
        return $this->sourceRepository->all();
    }
}
