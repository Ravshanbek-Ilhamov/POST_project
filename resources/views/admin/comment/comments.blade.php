@extends('layouts.adminLayout')

@section('title', 'Comments List')

@section('content')
<div class="content-wrapper">
    <section class="content">
        @if (auth()->user())
            <!-- Button to trigger create comment modal -->
            <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCommentModal">
                Create Comment
            </button>
        @endif

        <div class="container-fluid">
            <!-- Success and error messages -->
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

            <!-- Comments Table -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Post ID</th>
                        <th>User ID</th>
                        <th>Body</th>
                        @if (auth()->user())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->post_id }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->text }}</td>
                            @if (auth()->user())
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Edit button to trigger edit modal -->
                                        <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#editCommentModal{{ $item->id }}">
                                            Edit
                                        </button>
                                        
                                        <!-- Delete form -->
                                        <form action="{{ route('comment.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>                               
                            @endif
                        </tr>

                        <!-- Edit Comment Modal -->
                        <div class="modal fade" id="editCommentModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('comment.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Post ID Selection -->
                                            <div class="form-group">
                                                <label for="postSelect{{ $item->id }}">Post</label>
                                                <select class="form-control" name="post_id" id="postSelect{{ $item->id }}" required>
                                                    <option value="">Select a Post</option> <!-- Placeholder option -->
                                                    @foreach ($posts as $post)
                                                        <option value="{{ $post->id }}" {{ $post->id == $item->post_id ? 'selected' : '' }}>
                                                            {{ $post->title }} <!-- Assuming the Post model has a title attribute -->
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Comment Text Input -->
                                            <div class="form-group">
                                                <label for="text">Comment</label>
                                                <textarea class="form-control" name="text" id="text" rows="3" required>{{ $item->text }}</textarea>
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

                    @endforeach
                </tbody>
            </table>
            {{ $comments->links() }}
        </div>
    </section>
</div>

<!-- Create Comment Modal -->
<div class="modal fade" id="createCommentModal" tabindex="-1" role="dialog" aria-labelledby="createCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCommentModalLabel">Create Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Post ID Selection -->
                    <div class="form-group">
                        <label for="postSelect">Post</label>
                        <select class="form-control" name="post_id" id="postSelect" required>
                            <option value="">Select a Post</option> <!-- Placeholder option -->
                            @foreach ($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option> <!-- Assuming the Post model has a title attribute -->
                            @endforeach
                        </select>
                    </div>
                    <!-- Comment Text Input -->
                    <div class="form-group">
                        <label for="text">Comment</label>
                        <textarea class="form-control" name="text" id="text" rows="3" placeholder="Enter Comment Text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
