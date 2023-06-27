@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                           value="{{old('title')}}">
                    @error('title')
                    <p class="text-bg-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea type="text" class="form-control" name="content" id="content"
                              placeholder="Content">{{old('content')}}</textarea>
                    @error('content')
                    <p class="text-bg-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option
                                {{old('category_id') == $category->id ? 'selected' : ''}}
                                value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3">
                    <p><label for="image">Image:</label></p>
                    <input id="images" type="file" name="images[]" multiple/>
                    @error('images')
                    <p class="text-bg-danger">{{$message}}</p>
                    @enderror
                </div>
                <input type="text" hidden="hidden" name="user_id" value="{{$user->id}}">
                <button type="submit" class="btn btn-primary mt-2">Add</button>
            </form>
        </div>
    </div>
@endsection
