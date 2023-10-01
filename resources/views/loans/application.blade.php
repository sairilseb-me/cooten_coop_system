@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="row mb-3">
            <h3 class="mb-3">Members Loan Applications</h3>
            <div class="col-12 card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Applicant's Name</th>
                            <th>Loan Type</th>
                            <th>Loan Amount</th>
                            <th>Date Applied</th>
                            <th>Loan Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loan->user->name }} {{ $loan->user->last_name }}</td>
                                <td>{{ $loan->loan_type->name }}</td>
                                <td>₱{{ $loan->loan_amount }}</td>
                                <td>{{ $loan->date_applied }}</td>
                                <td>
                                    @if($loan->status == 0 )
                                        <span class="badge badge-warning">Pending Approval</span>
                                    @else
                                    <span class="badge badge-success">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#loan-details" data-loan="{{ $loan }}">Details</button>
                                    <button type="button" class="btn btn-success btn-sm">Approve</button>
                                    <button type="button" class="btn btn-danger btn-sm">Disapprove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- Loan Details Modal --}}
<div class="modal fade" id="loan-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Loan Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <img src="#" class="rounded mx-auto d-block" alt="..." id="profile_pic" style="height: 200px; width: 200px;">
                <div class="card-body">
                  <h5 class="card-title" id="user-name">Card title</h5>
                  <div class="form-group mb-3">
                    <label for="amount">Loan Amount:</label>
                    <input type="text" name="amount" id="amount" class="form-control" disabled>
                  </div>
                  <div class="form-group mb-3">
                    <label for="date_applied">Date Applied:</label>
                    <input type="text" name="date_applied" id="date-applied" class="form-control" disabled>
                  </div>
                  <div class="form-group mb-3">
                    <label for="reason">Reason: </label>
                    <textarea name="reason" id="reason" class="form-control" cols="10" rows="3" disabled></textarea>
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- End of Loan Details Modal --}}




@section('script')
    <script>
        $(document).ready(function(){

            var url = '{{ URL::asset('/storage/images/profile') }}'
            $('#loan-details').on('show.bs.modal', function(e){
                let loan = $(e.relatedTarget).data('loan')
                $('#profile_pic').attr('src', url + '/' + loan.user.profile_pic)
                $('#user-name').html(loan.user.name + ' ' + loan.user.last_name)
                $('#reason').val(loan.reason)
                $('#amount').val('₱' + loan.loan_amount.toLocaleString('en-US'))
                $('#date-applied').val(loan.date_applied.toLocaleString('en-US'))
            })
        })
    </script>
@endsection