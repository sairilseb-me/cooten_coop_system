@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h3>Users Page</h3>
            </div>
            <div class="col-12 d-flex justify-content-between mb-3">
                <a href="/register" class="btn btn-primary">Create User</a>
                <input type="text" name="search" id="search" placeholder="Search User..." class="px-2">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <p>{{ $error }}</p>
                        </div>
                    @endforeach
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            </div>
            <div class="col-12 mb-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }} {{ $user->last_name }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-modal" data-user="{{ $user }}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal" data-user="{{ $user }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- Edit Modal --}}

<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/admin/user/" method="POST" id="edit-form">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="roles">Select Role</label>
                        <select name="role" id="select-role" class="form-control"></select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
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

{{-- End Edit Modal --}}

{{-- Delete Modal --}}

<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" id="delete-form">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>You are about to delete <strong><span id="user-name"></span></strong>, continue?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
      </div>
    </div>
</div>

{{-- End Delete Modal --}}




@section('script')
    <script>
        $(document).ready(function(){

            let roles = {!! json_encode($roles->toArray(), JSON_HEX_TAG) !!}


            $('#edit-modal').on('show.bs.modal', function(e){ // Edit user show modal event
                let user = $(e.relatedTarget).data('user')
                $('.role-item').remove()
                roles.forEach(role => {
                    let list = '<option class="role-item" value="' + role.id + '">' + role.name + '</option>'
                    $('#select-role').append(list)
                });
                fillUserData(user)
                $('#edit-form').attr('action', '/admin/user/' + user.id)
            })

            $('#delete-modal').on('show.bs.modal', function(e){
                let user = $(e.relatedTarget).data('user')
                $('#user-name').text(user.name + ' ' + user.last_name)
                $('#delete-form').attr('action', '/admin/user/' + user.id)
            })

            function fillUserData(user) // Fill up the inputs with users data
            {
                $('#name').val(user.name)
                $('#last_name').val(user.last_name)
                $('#select-role').val(user.role_id)
                $('#email').val(user.email)
            }

        })
       
    </script>
@endsection