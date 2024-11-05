@extends('layouts.adminLayout')

@section('title', 'Request Page')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (auth()->check())
                <a href="#" class="btn btn-primary m-2" data-toggle="modal" data-target="#createRequestModal">Create</a>
                <!-- Create Request Modal -->
                <div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="createRequestModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <form action="/request-create" method="POST">
                        @csrf
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createRequestModalLabel">Create New Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="text">Text</label>
                            <textarea class="form-control" id="text" name="text" required></textarea>
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
  
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
                        <th>Text</th>
                        <th>Number of People</th>
                        <th>Created Time</th>
                        @if (auth()->check())
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->text }}</td>
                            <td>{{ $item->number_people }}</td>
                            <td>{{ $item->created_at }}</td>
                        
                            @if (auth()->check())
                            <td>
                                <div class="d-inline-flex">
                                    <a href="#" class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#editRequestModal" 
                                        data-id="{{ $item->id }}" 
                                        data-text="{{ $item->text }}" 
                                        data-number_people="{{ $item->number_people }}">
                                        Edit
                                    </a>
                                 
                                    <!-- Edit Request Modal -->
                                    <div class="modal fade" id="editRequestModal" tabindex="-1" role="dialog" aria-labelledby="editRequestModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <form id="editRequestForm" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRequestModalLabel">Edit Request</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                <label for="editText">Text</label>
                                                <textarea class="form-control" id="editText" name="text" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                <label for="editNumberPeople">Number of People</label>
                                                <input type="number" class="form-control" id="editNumberPeople" name="number_people" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
  
                                    <form action="/request-delete/{{ $item->id }}" method="POST" style="display:inline;">
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
            {{ $requests->links() }}
        </div>
    </section>
</div>
<script>
$('#editRequestModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var text = button.data('text');
    var numberPeople = button.data('number_people');
    
    var modal = $(this);
    modal.find('#editText').val(text);
    modal.find('#editNumberPeople').val(numberPeople);
    
    // Use Laravel route helper with the correct ID
    $('#editRequestForm').attr('action', '/request-edit/' + id);
});

  </script>
  
@endsection
