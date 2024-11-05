@extends('layouts.adminLayout')

@section('title', 'Answer Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (auth()->check())
                <a href="/answer-create" class='btn btn-primary m-2'>Create</a>
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
                        <th>User</th>
                        <th>Request</th>
                        <th>Option</th>
                        <th>Created Time</th>
                        @if (auth()->check())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user_IP }}</td>
                            <td>{{ $item->requests->text }}</td>
                            <td>{{ $item->option->text }}</td>
                            <td>{{ $item->created_at }}</td>
                        
                            @if (auth()->check())
                            <td>
                                <div class="d-inline-flex">
                                    <a href="/answer-edit/{{ $item->id }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                                    <form action="/answer-delete/{{ $item->id }}" method="POST" style="display:inline;">
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
            {{ $answers->links() }}
        </div>
    </section>
</div>
@endsection
