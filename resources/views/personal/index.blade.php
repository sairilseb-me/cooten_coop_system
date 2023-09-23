@extends('layouts.admin')


@section('main-content')
   <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/profile/'.$user->profile_pic) }}" class="rounded mx-auto d-block img-thumbnail border-0" width="70%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h2>Profile</h2>
                            <h5 class="card-title"><strong>Name:</strong> {{ $user->name }} {{ $user->last_name }}</h5>
                            <p class="card-text"><strong>Phone Number:</strong> {{ $user->contact_number }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="card-text"><strong>Address:</strong> {{ $user->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3"> 
                    <div class="card col-12 mb-3">
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#apply-loan" data-user="{{ $user }}">Apply for a new Loan</button>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
    
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <table class="table">
                                <thead>
                                    <th>Loan</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Remaining Balance</th>
                                    <th>Options</th>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ $loan->loan_type->name }}</td>
                                            <td>₱{{ $loan->loan_amount }}</td>
                                                @if ($loan->loan_request_status == 0)
                                                    <td><span class="badge badge-warning">Pending</span></td>
                                                @else
                                                    <td><span class="badge badge-success">Approved</span></td>
                                                @endif
                                            <td>
                                                @if($loan->payment_status == 0)
                                                    <span class="badge badge-secondary">N/A</span>
                                                @elseif ($loan->payment_status == 1)
                                                    <span class="badge badge-warning">Currently Paying</span>
                                                @else
                                                    <span class="badge badge-success">Paid</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-secondary">N/A</span>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary btn-sm">View Payments</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection


{{-- Loan Application Modal --}}
<div class="modal fade" id="apply-loan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="personal/loan-apply" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="user-id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="loan-type">Loan Type</label>
                        <select name="loan_type" id="loan-type" class="form-control">
                            <option selected disabled>Select a Loan Type</option>
                        </select>
                    </div>
                    <label for="loan-amount">Loan Amount</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="number" name="loan_amount" id="loan-amount" class="form-control" placeholder="Enter Loan Amount...">
                    </div>
                    <div class="form-group mb-3">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" cols="30" rows="3" placeholder="Enter Reason..." class="form-control"></textarea>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Apply for a Loan</button>
              </div>
        </form>
      </div>
    </div>
</div>

{{-- End of application modal --}}

@section('script')
    <script>
        $(document).ready(function(){
            let loan_types = {!! json_encode($loan_types->toArray()) !!}
            fillLoanTypes()

            $('#apply-loan').on('show.bs.modal', function(e){
                let user = $(e.relatedTarget).data('user')
                $('#user-id').val(user.id)
            })

            function fillLoanTypes()
            {
                $('.type-item').remove()
                loan_types.forEach(type => {
                    let list = '<option class="type-item" value="' + type.id + '">' + type.name + '</option>'
                    $('#loan-type').append(list)
                });
            }
        })
    </script>
@endsection