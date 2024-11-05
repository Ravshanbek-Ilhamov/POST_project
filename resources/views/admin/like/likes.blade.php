@extends('layouts.adminLayout')

@section('title', 'Index Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if (auth()->user())
                <!-- Button to trigger create comment modal -->
                <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createLikeModal">
                    Create Like
                </button>
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
                        <th>Post</th>
                        <th>User</th>
                        <th>Like Or DisLike</th>
                        @if (auth()->user())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($likes as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item->posts->title }}</td>
                            <td>{{ $item->users->name }}</td>
                            <td>{{ $item['value'] == 1 ? 'Like' : 'Dislike' }}</td>
                            @if (auth()->user())
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Edit button to trigger edit modal -->
                                        <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#editLikeModal{{ $item->id }}">
                                            Edit
                                        </button>

                                        <!-- Edit Like Modal -->
                                        <div class="modal fade" id="editLikeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editLikeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLikeModalLabel">Edit Like</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('like.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Post ID Selection -->
                                                            <div class="form-group">
                                                                <label for="postSelect{{ $item->id }}">Post</label>
                                                                <select class="form-control" name="post_id" id="postSelect{{ $item->id }}" required>
                                                                    @foreach ($posts as $post)
                                                                        <option value="{{ $post->id }}" {{ $post->id == $item->post_id ? 'selected' : '' }}>
                                                                            {{ $post->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="userSelect{{ $item->id }}">User</label>
                                                                <select class="form-control" name="user_id" id="userSelect{{ $item->id }}" required>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}" {{ $user->id == $item->user_id ? 'selected' : '' }}>
                                                                            {{ $user->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="likeSelect{{ $item->id }}">Like Or Dislike</label>
                                                                <select class="form-control" name="value" id="likeSelect{{ $item->id }}" required>
                                                                    <option value="1" {{ $item->value == 1 ? 'selected' : '' }}>Like</option>
                                                                    <option value="0" {{ $item->value == 0 ? 'selected' : '' }}>Dislike</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete form -->
                                        <form action="{{ route('like.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>                               
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $likes->links() }}
        </div>
    </section>
</div>

<!-- Create Comment Modal -->
<div class="modal fade" id="createLikeModal" tabindex="-1" role="dialog" aria-labelledby="createLikeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLikeModalLabel">Create Like</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('like.store', $item->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Post ID Selection -->
                    <div class="form-group">
                        <label for="postSelect{{ $item->id }}">Post</label>
                        <select class="form-control" name="post_id" id="postSelect{{ $item->id }}" required>
                            <option value="">Select a Post</option> <!-- Placeholder option -->
                            @foreach ($posts as $post)
                                <option value="{{$post->id}}">{{$post->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="userSelect{{ $item->id }}">User</label>
                        <select class="form-control" name="user_id" id="userSelect{{ $item->id }}" required>
                            <option value="">Select a User</option> <!-- Placeholder option -->
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="likeSelect{{ $item->id }}">Like Or Dislike</label>
                        <select class="form-control" name="value" id="likeSelect{{ $item->id }}" required>
                            <option value="1">Like</option>
                            <option value="0">Dislike</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
