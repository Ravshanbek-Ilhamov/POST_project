@extends('layouts.adminLayout')

@section('title', 'Post Creation')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <a href="/posts" class="btn btn-primary m-2">Posts</a>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Post</h3>
                        </div>
                        <form action="/post_creation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                                <!-- Category Selection -->
                                <div class="form-group">
                                    <label for="categorySelect">Category</label>
                                    <select class="form-control" name="category_id" id="categorySelect">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Title Input -->
                                <div class="form-group">
                                    <label for="titleInput">Title</label>
                                    <input type="text" class="form-control" name="title" id="titleInput" placeholder="Enter post title">
                                    @error('title')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Description Input -->
                                <div class="form-group">
                                    <label for="descriptionInput">Description</label>
                                    <textarea class="form-control" name="description" id="descriptionInput" rows="3" placeholder="Enter description"></textarea>
                                    @error('description')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Text Input -->
                                <div class="form-group">
                                    <label for="textInput">Text</label>
                                    <textarea class="form-control" name="text" id="textInput" rows="5" placeholder="Enter post text"></textarea>
                                    @error('text')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="imageInput">Image</label>
                                    <input type="file" class="form-control-file" name="image_path" id="imageInput">
                                    @error('image_path')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Likes Input -->
                                <div class="form-group">
                                    <label for="likesInput">Likes</label>
                                    <input type="number" class="form-control" name="likes" id="likesInput" value="0">
                                    @error('likes')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Dislikes Input -->
                                <div class="form-group">
                                    <label for="dislikesInput">Dislikes</label>
                                    <input type="number" class="form-control" name="dislikes" id="dislikesInput" value="0">
                                    @error('dislikes')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <!-- Number of Views Input -->
                                <div class="form-group">
                                    <label for="viewsInput">Number of Views</label>
                                    <input type="number" class="form-control" name="number_view" id="viewsInput" value="0">
                                    @error('number_view')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection
