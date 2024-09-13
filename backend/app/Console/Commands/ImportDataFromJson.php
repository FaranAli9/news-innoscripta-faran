<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Author;
use App\Models\Source;
use Illuminate\Console\Command;

class ImportDataFromJson extends Command
{
    protected $signature = 'news:data:import';

    protected $description = 'Import authors, sources, and articles from JSON files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->importAuthors();
        $this->importSources();
        $this->importArticles();
    }

    private function importAuthors(): void
    {
        $path = database_path('exports/authors.json');

        if (! file_exists($path)) {
            $this->error('JSON file does not exist at '.$path);

            return;
        }

        $jsonData = file_get_contents($path);
        $authors  = json_decode($jsonData, true);

        $chunks = array_chunk($authors, 1000); // Adjust chunk size as needed

        foreach ($chunks as $chunk) {
            foreach ($chunk as $author) {
                Author::updateOrCreate(
                    ['id' => $author['id']],
                    $author
                );
            }
        }

        $this->info('Authors have been imported from '.$path);
    }

    private function importSources(): void
    {
        $path = database_path('exports/sources.json');

        if (! file_exists($path)) {
            $this->error('JSON file does not exist at '.$path);

            return;
        }

        $jsonData = file_get_contents($path);
        $sources  = json_decode($jsonData, true);

        $chunks = array_chunk($sources, 400);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $source) {
                Source::updateOrCreate(
                    ['id' => $source['id']],
                    $source
                );
            }
        }

        $this->info('Sources have been imported from '.$path);
    }

    private function importArticles(): void
    {
        $path = database_path('exports/articles.json');

        if (! file_exists($path)) {
            $this->error('JSON file does not exist at '.$path);

            return;
        }

        $jsonData = file_get_contents($path);
        $articles = json_decode($jsonData, true);

        $chunks = array_chunk($articles, 400);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $article) {
                Article::updateOrCreate(
                    ['id' => $article['id']],
                    $article
                );
            }
        }

        $this->info('Articles have been imported from '.$path);
    }
}
