<?php

namespace App\Repository\Interfaces;

use App\Data\DTO\Source\SourceDTO;
use App\Models\Source;
use Illuminate\Database\Eloquent\Collection;

interface ISourceRepository
{
    public function all(): Collection;

    public function firstOrCreate(array $attributes, ?SourceDTO $dto = null): Source;
}
