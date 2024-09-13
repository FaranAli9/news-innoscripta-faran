<?php

namespace App\Http\Controllers\Lookup;

use App\Http\Controllers\Controller;
use App\Http\Resources\SourceResource;
use App\Services\Source\Interfaces\ISourceService;

class LookupSourcesController extends Controller
{
    private ISourceService $sourceService;

    public function __construct(ISourceService $sourceService)
    {
        $this->sourceService = $sourceService;
    }

    public function __invoke()
    {
        $sources = $this->sourceService->getAllSources();

        return response()->json([
            'sources' => SourceResource::collection($sources),
        ]);
    }
}
