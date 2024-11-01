@extends('layouts.adminLayout')

@section('title', 'Index Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (auth()->check())
                <a href="/post-create" class='btn btn-primary m-2'>Create</a>
            @endif

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

            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Text</th>
                        <th>Image</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
                        <th>Views</th>
                        @if (auth()->check())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>{{ Str::limit($item->text, 50) }}</td>
                            <td>
                                @if($item->image_path)
                                    <img src="{{ asset($item->image_path) }}" alt="Image" style="width: 50px; height: 50px;">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>{{ $item->likes }}</td>
                            <td>{{ $item->dislikes }}</td>
                            <td>{{ $item->number_view }}</td>
                            @if (auth()->check())
                            <td>
                                <div class="d-inline-flex">
                                    <a href="/post-edit/{{ $item->id }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                                    <form action="/post-delete/{{ $item->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>                            
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </section>
</div>
@endsection
