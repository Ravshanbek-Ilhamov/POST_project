@extends('layouts.adminLayout')

@section('title', 'Category List')

@section('content')
<div class="content-wrapper">
    <section class="content">
        @if (auth()->check())
        <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategoryModal">
          Create Category
        </button>
        
        <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form action="{{ route('category.store') }}" method="POST">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                  </div>
        
                  <div class="form-group">
                    <label for="tr">T/R</label>
                    <input type="text" class="form-control" id="tr" name="tr" value="{{ old('tr') }}" required>
                  </div>
        
                  <div class="form-group">
                    <label for="active">Active</label>
                    <select class="form-control" id="active" name="active">
                      <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Yes</option>
                      <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
              </div>
            </form>
          </div>
        </div>
                  {{-- <a href="/category-create" class='btn btn-primary m-2'>Create Category</a> --}}
        @endif
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
                  {{-- <strong>{{ session('error') }}</strong> --}}
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
                        <th>T/R</th>
                        <th>Name</th>
                        <th>Active</th>
                        @if (auth()->check())
                          <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item  )
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->tr }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->active ? 'Yes' : 'No' }}</td>
                            @if (auth()->check())
                              <td>
                                <a href="javascript:void(0)" onclick="editCategory({{ $item->id }}, '{{ $item->name }}', {{ $item->tr }}, {{ $item->active }})"
                                   class="btn btn-sm btn-warning">Edit
                                </a>

                                {{-- Modal --}}
                                <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <form id="editCategoryForm" action="" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <input type="hidden" id="editCategoryId" name="id">
                                
                                          <div class="form-group">
                                            <label for="editName">Name</label>
                                            <input type="text" class="form-control" id="editName" name="name" value="{{ old('name') }}">
                                          </div>
                                          
                                          <div class="form-group">
                                            <label for="editTr">T/R</label>
                                            <input type="text" class="form-control" id="editTr" name="tr" value="{{ old('tr') }}">
                                          </div>
                                
                                          <div class="form-group">
                                            <label for="editActive">Active</label>
                                            <select class="form-control" id="editActive" name="active">
                                              <option value="1">Yes</option>
                                              <option value="0">No</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                
                                  <form action="/category-delete/{{ $item->id }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                  </form>
                              </td>
                            @endif
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </section>
    </div>
    <script>
      function editCategory(id, name, tr, active) {
        $('#editCategoryModal').modal('show');
        $('#editCategoryId').val(id);
        $('#editName').val(name);
        $('#editTr').val(tr);
        $('#editActive').val(active);
        $('#editCategoryForm').attr('action', '/category-update/' + id); // Update form action URL
      }
    </script>
    
        
@endsection
