@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="row">
            <div class='col-9 center-block p-3 my-2'>
                <div class='card-body'>
                    <h3 class=' text-center mb-4'>{!! $post->title !!}</h3>
                    <div>
                        {!! $post->content !!}
                    </div>
                    <ul class='list group list-group-flush h6'>
                        <li class='list-group-item'>
                            <b>Категория: </b><i>{{$post->category->name}}</i>
                        </li>
                        <li class='list-group-item'>
                            <b>Дата: </b><i>{{$post->created_at}}</i>
                        </li>
                        <li class='list-group-item'>
                            <b>Автор: </b><i>{{$post->user->name}}</i>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-3 p-3 my-2 border">
                <h3 class="text-info text-center">Similar news</h3>
                @if(count($similarPosts) === 0)
                    <p class="display-4 text-success">Your ADS can be here!</p>
                @else()
                    @foreach($similarPosts as $similarPost)
                        <div class="my-2">
                            <a class="link-underline-info" href="{{route('post.show',$similarPost->slug)}}">{{$similarPost->title}}</a>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
