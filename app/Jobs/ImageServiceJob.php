<?php

namespace App\Jobs;

use App\Models\Image;
use App\Models\Post;
use App\Services\Image\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImageServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private string $fileName;

    public function __construct(private $image, private readonly Post $post)
    {
        $this->fileName = explode('/', $this->image)[count(explode('/', $this->image)) - 1];
    }

    /**
     * Execute the job.
     */
    public function handle(ImageService $imageService): void
    {

        $imageService->cleanImage(Storage::path($this->image));
        Storage::copy($this->image, 'images/' . $this->fileName);

        $imageService->makeMediumImage(Storage::path($this->image));
        Storage::copy($this->image, 'md-images/' . $this->fileName);

        $imageService->makeSmallImage(Storage::path($this->image));
        Storage::copy($this->image, 'sm-images/' . $this->fileName);

        $postId = $this->post->id;

        Image::create([
            'original_image' => 'images/' . $this->fileName,
            'small_image' => 'sm-images/' . $this->fileName,
            'medium_image' => 'md-images/' . $this->fileName,
            'post_id' => $postId,
        ]);
        Storage::delete($this->image);
    }
}
