@extends('layouts.admin')


@section('main-content')
   <div class="container">
        <div class="row">
            <div class="col-12">
                <div>

                </div>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/profile/'.$user->profile_pic) }}" class="rounded mx-auto d-block img-thumbnail border-0" width="70%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h2>{{ strtoupper($user->name) }} Profile</h2>
                            <h5 class="card-title">{{ $user->name }} {{ $user->last_name }}</h5>
                            <p class="card-text"><strong>Phone Number:</strong> {{ $user->contact_number }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="card-text"><strong>Address:</strong> {{ $user->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <table class="table">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection