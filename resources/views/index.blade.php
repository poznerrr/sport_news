@extends('layouts.app')
    @section('main')
    @foreach($posts as $post)
        <div class='card center-block p-3 my-2'>
            <div class='card-body'>
                <a href="{{route('news-post',[$post->slug])}}" class='card-title text-left'>{!! $post->title!!}</a>
                <ul class='list group list-group-flush mt-3 h6'>
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
    @endforeach
{{$posts->links()}}
    @endsection
