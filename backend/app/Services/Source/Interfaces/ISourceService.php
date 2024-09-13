<?php

namespace App\Services\Source\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ISourceService
{
    public function getAllSources(): Collection;
}
