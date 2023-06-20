<?php
declare(strict_types=1);

namespace App\Services\Image;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function store($image, Post $post): Image
    {
        $this->cleanImage($image->path());
        $originalImage = Storage::put('images', $image);

        $this->makeMediumImage($image->path());
        $mediumImage = Storage::put('md-images', $image);

        $this->makeSmallImage($image->path());
        $smallImage = Storage::put('sm-images', $image);

        $postId = $post->id;

        return Image::create([
            'original_image' => $originalImage,
            'small_image' => $smallImage,
            'medium_image' => $mediumImage,
            'post_id' => $postId,
        ]);
    }

    public function cleanImage($img): void
    {
        $imagick = new \Imagick($img);
        $profiles = $imagick->getImageProfiles("icc", true);
        $imagick->stripImage();

        if (!empty($profiles)) {
            $imagick->profileImage("icc", $profiles['icc']);
        }

        $imagick->writeImage($img);
        $imagick->destroy();
    }

    public function makeMediumImage($img)
    {
        $imagick = new \Imagick($img);
        $imagick->thumbnailImage(500, 500, true);
        $imagick->writeImage("webp:" . $img);
        $imagick->destroy();
    }

    public function makeSmallImage($img)
    {
        $imagick = new \Imagick($img);
        $imagick->thumbnailImage(150, 150, true);
        $imagick->writeImage("webp:" . $img);
        $imagick->destroy();
    }
}
