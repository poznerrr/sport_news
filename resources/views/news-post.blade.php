@extends('layouts.app')
@section('main')
    <div class=' center-block p-3 my-2'>
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
@endsection
