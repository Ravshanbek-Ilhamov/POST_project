@extends('layouts.adminLayout')

@section('title', 'Index Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if (auth()->user())
                <!-- Button to trigger create comment modal -->
                <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createViewModal">
                    Create View
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
                        <th>User IP</th>
                        @if (auth()->user())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($views as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item->post->title }}</td>
                            <td>{{ $item['user_IP'] }}</td>
                            @if (auth()->user())
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Edit button to trigger edit modal -->
                                    <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#editViewModal{{ $item->id }}">
                                        Edit
                                    </button>

                                        <!-- Edit Like Modal -->
                                        <div class="modal fade" id="editViewModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editViewModalLabel">Edit View</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('view.update', $item->id) }}" method="POST">
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

                                                            <!-- User IP Input -->
                                                            <div class="form-group">
                                                                <label for="userIP{{ $item->id }}">User IP</label>
                                                                <input type="text" class="form-control" name="user_IP" id="userIP{{ $item->id }}" value="{{ $item->user_IP }}" required>
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
                                    <form action="{{ route('view.destroy', $item->id) }}" method="POST" style="display:inline;">
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
            {{ $views->links() }}
        </div>
    </section>
</div>

<!-- Create View Modal -->
<div class="modal fade" id="createViewModal" tabindex="-1" role="dialog" aria-labelledby="createViewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createViewModalLabel">Create View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('view.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Post ID Selection -->
                    <div class="form-group">
                        <label for="postSelect">Post</label>
                        <select class="form-control" name="post_id" id="postSelect" required>
                            <option value="">Select a Post</option> <!-- Placeholder option -->
                            @foreach ($posts as $post)
                                <option value="{{$post->id}}">{{$post->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- User IP Input -->
                    <div class="form-group">
                        <label for="userIP">User IP</label>
                        <input type="text" class="form-control" name="user_IP" id="userIP" placeholder="Enter User IP" required>
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
