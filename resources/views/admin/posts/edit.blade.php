@extends('admin.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <label>Title</label>
                            <div class="form-group">
                                <input class="w-50" type="text" placeholder="Title of post" name="title"
                                       value="{{$post->title}}">
                            </div>
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <label>Text content</label>
                            <div class="form-group w-75">
                                <textarea id="summernote" name="content">{{$post->content}}</textarea>
                            </div>
                            @error('content')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group w-50">
                                <label>Images:</label>
                                @foreach($post->images as $image)
                                    <div class="w-50 m-1">
                                        <img src="{{asset('storage/'.$image->small_image)}}" alt="image">
                                    </div>
                                @endforeach

                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="images[]" multiple>
                                        <label class="custom-file-label">Add images</label>
                                    </div>
                                </div>
                            </div>
                            @error('images')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <div class="form-group w-50">
                                <label>Category</label>
                                <select class="form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{$category->id === $post->category_id ? 'selected': ''}}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input hidden="hidden" name="user_id" value="{{$post->user_id}}">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Edit">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
