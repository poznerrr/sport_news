<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\FillerSimilars;
use Illuminate\Console\Command;

class SyncSimilarNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-similar-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync similar news tables via fulltext index';

    /**
     * Execute the console command.
     */
    public function handle(FillerSimilars $fillerSimilars)
    {
        try {
            $posts = Post::all();

            $bar = $this->output->createProgressBar(count($posts));
            $bar->start();

            foreach ($posts as $post) {
                $fillerSimilars->fill($post);
                $bar->advance();
            }
            $bar->finish();
            $this->newLine();
            $this->info('finished successfully');
        } catch (\Throwable $e) {
            $this->newLine();
            $this->error("Error : {$e->getMessage()}");
            $this->info('finished unsuccessfully');
        }
    }
}
