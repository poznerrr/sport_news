<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Jobs\ImageServiceJob;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\FillerSimilars;
use App\Services\Image\ImageService;
use App\Services\Post\PostService;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(15);
        return view('post.index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $similarPosts = $post->similarPosts;
        return view('post.show', compact('post', 'similarPosts'));
    }

    public function create()
    {
        $categories = Category::all();
        $user = User::where('name', 'Administrator')->first();
        return view('post.create', compact('categories', 'user'));
    }

    public function store(StoreRequest $request, FillerSimilars $fillerSimilars, ImageService $imageService)
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
        $post = $this->service->store($data);

        $fillerSimilars->fill($post);

        if ($images !== null) {
            foreach ($uploadImages as $image) {
                ImageServiceJob::dispatch($image, $post);
                //$imageService->store($image, $post);
            }
        }

        return redirect()->route('index');
    }

    public function rss(): Response
    {
        $posts = Post::latest()->take(100)->get();
        return response()->view('rss', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}
