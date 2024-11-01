@extends('layouts.adminLayout')

@section('title', 'Edit Post')

@section('content')

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<div class="content-wrapper">
    <section class="content">
        <a href="/posts" class="btn btn-primary m-2">Posts</a>
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{ session('success') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
      
            @if (session('error'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('error') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        
                        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categorySelect">Category</label>
                                    <select class="form-control" name="category_id" id="categorySelect">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}" {{ $category['id'] == $post->category_id ? 'selected' : '' }}>
                                                {{ $category['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="titleInput">Title</label>
                                    <input type="text" class="form-control" name="title" id="titleInput" value="{{ $post->title }}">
                                    @error('title')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="descriptionInput">Description</label>
                                    <textarea class="form-control" name="description" id="descriptionInput" rows="3">{{ $post->description }}</textarea>
                                    @error('description')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="textInput">Text</label>
                                    <textarea class="form-control" name="text" id="textInput" rows="5">{{ $post->text }}</textarea>
                                    @error('text')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="imageInput">Image</label>
                                    <input type="file" class="form-control" name="image_path" id="imageInput">
                                    @if ($post->image_path)
                                        <img src="{{ asset($post->image_path) }}" alt="Current Image" style="width: 100px; margin-top: 10px;">
                                    @endif
                                    @error('image_path')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="likesInput">Likes</label>
                                    <input type="number" class="form-control" name="likes" id="likesInput" value="{{ old('likes', $post->likes) }}">
                                    @error('likes')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="dislikesInput">Dislikes</label>
                                    <input type="number" class="form-control" name="dislikes" id="dislikesInput" value="{{ old('dislikes', $post->dislikes) }}">
                                    @error('dislikes')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="viewsInput">Views</label>
                                    <input type="number" class="form-control" name="number_view" id="viewsInput" value="{{ old('number_view', $post->number_view) }}">
                                    @error('number_view')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection
