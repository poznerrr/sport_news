<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\FillerSimilars;
use App\Services\Image\ImageService;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        $image = $data['image'] ?? null;

        if ($image) {
            unset($data['image']);
        }

        $post = $this->service->store($data);

        $fillerSimilars->fill($post);

        if ($image) {
            $imageService->store($image, $post);
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
