<?php

namespace App\Services\Author\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IAuthorService
{
    public function getAllAuthors(): Collection;
}
