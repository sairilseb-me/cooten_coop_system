@extends('layouts.admin')

@section('main-content')
    <div class="container">
       <div class="row mb-3">
            <div class="col-12 mb-3">
                <h3>Loans Settings</h3>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#control-modal">Add new Loan Type</button>
            </div>
       </div>
       <div class="row">
            <div class="col-12">
                @if(session('success'))
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
                            <th>Loan Name</th>
                            <th class="d-flex justify-content-end mr-4">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loan_types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#control-modal" data-type={{ $type }}>Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal" data-type={{ $type }}>Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       </div>
    </div>
@endsection

{{-- Control Modal --}}

<div class="modal fade" id="control-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/admin/loan" method="POST" id="control-form">
            @csrf
            <input type="hidden" name="_method" value="POST" id="method-input">
            <div class="modal-header">
                <h5 class="modal-title" id="control-modal-label">Add New Loan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="loan-type">Loan Name</label>
                    <input type="text" name="loan" id="loan-type" class="form-control" placeholder="Enter Loan Name">
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

{{-- End Control Modal --}}

{{-- Delete Modal --}}

<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/admin/loan" method="POST" id="delete-form">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h5 class="modal-title">Delete Loan Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>You are about to delete <strong><span id="delete-type-label"></span></strong>, continue?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete Loan</button>
              </div>
        </form>
        
      </div>
    </div>
</div>

{{-- End of Delete Modal --}}


@section('script')
    <script>
        $('#control-modal').on('show.bs.modal', function(e){
            clearInputs()
            let type = $(e.relatedTarget).data('type');
            if(type)
            {
                $('#loan-type').val(type.name)
                $('#method-input').val('PUT')
                $('#control-form').attr('action', '/admin/loan/' + type.id)
                $('#control-modal-label').text('Edit Loan')
            }
        })

        $('#delete-modal').on('show.bs.modal', function(e){
            let type = $(e.relatedTarget).data('type')
            $('#delete-type-label').text(type.name)
            $('#delete-form').attr('action', '/admin/loan/' + type.id)
        })

        function clearInputs()
        {
            $('#loan-type').val('')
            $('#method-input').val('POST')
            $('#control-form').attr('action', '/admin/loan')
            $('#control-modal-label').text('Add New Loan')
        }
    </script>
@endsection