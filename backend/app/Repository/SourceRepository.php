<?php

namespace App\Repository;

use App\Data\DTO\Source\SourceDTO;
use App\Models\Source;
use App\Repository\Interfaces\ISourceRepository;
use Illuminate\Database\Eloquent\Collection;

class SourceRepository implements ISourceRepository
{
    public function all(): Collection
    {
        return Source::all();
    }

    public function firstOrCreate(array $attributes, ?SourceDTO $dto = null): Source
    {
        $values = $dto ? $dto->toArray() : [];

        return Source::firstOrCreate($attributes, $values);
    }
}
