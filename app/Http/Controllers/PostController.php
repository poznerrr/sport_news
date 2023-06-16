<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Post\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(15);
        return view('post.index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('post.show', ['post' => $post]);
    }

    public function create()
    {
        $categories = Category::all();
        $user = User::where('name', 'Administrator')->first();
        return view('post.create', compact('categories', 'user'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

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
