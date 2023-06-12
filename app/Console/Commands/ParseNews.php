<?php

namespace App\Console\Commands;

use App\Services\ContentGetter;
use App\Services\ContentParser;
use App\Services\ContentWriter;
use Illuminate\Console\Command;

class ParseNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-news {linksPath : path of .csv file with links}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill your database with news from given links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $contentGetter = new ContentGetter($this->argument('linksPath'));
            if ($contentGetter->isValid()) {
                $contents = $contentGetter->getContents();
                foreach ($contents as $key => $content) {
                    $this->line("Record №$key is being processed");
                    $parsedContent = (new ContentParser())->parseContent($content);
                    if ($parsedContent->isValid()) {
                        (new ContentWriter($parsedContent))->writeAdminBasketballNews();
                    } else {
                        $this->warn("Record {$key}: unhandled title or content");
                    }
                }
            } else {
                $this->error("Unresolved path");
            }
        } catch (\Throwable $e) {
            $this->error("Error : {$e->getMessage()}");
        }
        $this->info('finished');
    }
}
