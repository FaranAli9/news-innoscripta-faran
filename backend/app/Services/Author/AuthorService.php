<?php

namespace App\Services\Author;

use App\Repository\Interfaces\IAuthorRepository;
use App\Services\Author\Interfaces\IAuthorService;
use Illuminate\Database\Eloquent\Collection;

class AuthorService implements IAuthorService
{
    protected IAuthorRepository $authorRepository;

    public function __construct(IAuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAllAuthors(): Collection
    {
        return $this->authorRepository->all();
    }
}
