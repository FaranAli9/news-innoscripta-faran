<?php

namespace App\Http\Controllers\Lookup;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Services\Author\Interfaces\IAuthorService;

class LookupAuthorsController extends Controller
{
    private IAuthorService $authorService;

    public function __construct(IAuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function __invoke()
    {
        $authors = $this->authorService->getAllAuthors();

        return response()->json([
            'authors' => AuthorResource::collection($authors),
        ]);
    }
}
