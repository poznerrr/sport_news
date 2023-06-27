<?php
declare(strict_types=1);

namespace App\Services\Image;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ImageService
{
    public function cleanImage($img): void
    {
        try {
            $imagick = new \Imagick($img);
            $profiles = $imagick->getImageProfiles("icc", true);
            $imagick->stripImage();

            if (!empty($profiles)) {
                $imagick->profileImage("icc", $profiles['icc']);
            }

            $imagick->writeImage($img);
            $imagick->destroy();
        }
        catch (Exception $e) {
            $e->getMessage();
        }
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
