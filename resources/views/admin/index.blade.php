@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <h3>Admin Settings</h3>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 d-flex">
                <div class="col-sm-6">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Settings</h5>
                        <p class="card-text">Create user, add roles, edit and delete</p>
                        <a href="/admin/user" class="btn btn-primary">Go to User Settings</a>
                    </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Loan Settings</h5>
                        <p class="card-text">Create loans, add , edit and delete</p>
                        <a href="/user" class="btn btn-primary">Go to Loan Settings</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
