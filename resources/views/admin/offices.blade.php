@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <h3>Offices Settings</h3>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#control-modal">Add new Office</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Office Name</th>
                            <th class="d-flex justify-content-end mr-3">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices as $office)
                            <tr>
                                <td>{{ $office->name }}</td>
                                <td class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#control-modal" data-office="{{ $office }}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal" data-office="{{ $office }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<!-- Control Modal -->
<div class="modal fade" id="control-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/admin/office" method="POST" id="control-form">
            @csrf
            <input type="hidden" name="_method" value="POST" id="input-control">
            <div class="modal-header">
                <h5 class="modal-title" id="control-modal-label">Add new Office</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-group">
                        <label for="office">Office Name</label>
                        <input type="text" name="office" id="office" class="form-control" placeholder="Enter Office Name...">
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        
      </div>
    </div>
</div>

{{-- End of Control Modal --}}

{{-- Delete Modal --}}
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/admin/office" method="POST" id="delete-form">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h5 class="modal-title" id="control-modal-label">Delete an Office</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <p>You are about to delete an Office: <strong><span id="delete-office-name"></span></strong>, Continue?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
        
      </div>
    </div>
</div>
{{-- End of delete modal --}}


@section('script')
    <script>
        $(document).ready(function(){
            $('#control-modal').on('show.bs.modal', function(e){
                let office = $(e.relatedTarget).data('office')
                if(office)
                {
                    $('#office').val(office.name)
                    $('#control-form').attr('action', '/admin/office/' + office.id)
                    $('#input-control').val('PUT')
                }
            })

            $('#delete-modal').on('show.bs.modal', function(e){
                let office = $(e.relatedTarget).data('office')
                $('#delete-office-name').text(office.name)
                $('#delete-form').attr('action', '/admin/office/' + office.id)
            })
        })
    </script>
@endsection