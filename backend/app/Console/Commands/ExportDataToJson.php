<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Author;
use App\Models\Source;
use Illuminate\Console\Command;

class ExportDataToJson extends Command
{
    protected $signature = 'news:data:export';

    protected $description = 'Export authors, sources, and articles to JSON files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $paths = [
            'authors'  => database_path('exports/authors.json'),
            'sources'  => database_path('exports/sources.json'),
            'articles' => database_path('exports/articles.json'),
        ];

        foreach ($paths as $path) {
            if (! file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }
        }

        $authors = Author::all()->toArray();
        file_put_contents($paths['authors'], json_encode($authors, JSON_PRETTY_PRINT));

        $sources = Source::all()->toArray();
        file_put_contents($paths['sources'], json_encode($sources, JSON_PRETTY_PRINT));

        $articles = Article::all()->toArray();
        file_put_contents($paths['articles'], json_encode($articles, JSON_PRETTY_PRINT));

        $this->info('Data has been exported to JSON files.');
    }
}
