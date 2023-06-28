<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Jobs\ImageServiceJob;
use App\Services\FillerSimilars;
use App\Services\Post\PostService;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, FillerSimilars $fillerSimilars, PostService $service)
    {
        $data = $request->validated();


        $images = $data['images'] ?? null;

        $uploadImages = [];
        if ($images !== null) {
            unset($data['images']);
            foreach ($images as $image) {
                $uploadImages[] = $image->store('tmp');
            }
        }
        $post = $service->store($data);

        $fillerSimilars->fill($post);

        if ($images !== null) {
            foreach ($uploadImages as $image) {
                ImageServiceJob::dispatch($image, $post);
            }
        }

        return redirect()->route('index');

    }
}

