@extends('layouts.adminLayout')

@section('title', 'Index Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Search form -->
            <div class="row">
                {{-- <div class="col-5">
                    <a href="/user-create" class='btn btn-primary m-2'>Create</a>
                </div> --}}
                
                <div class="col-10">
                    <form action="{{ route('user.index') }}" method="GET" class="form-inline mb-3">
                        <input type="text" name="search" id="#search" class="form-control mr-2" placeholder="Search users..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary ml-2">Clear</a>
                    </form>
                </div>
            </div>
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
                {{-- <strong>{{ session('error') }}</strong> --}}
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        @endif
            <table class="table table-striped table-bordered" id="#userTableBody">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </section>
</div>
@endsection
