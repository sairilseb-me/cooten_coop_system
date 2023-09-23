@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}" class="user" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="date" name="date_of_birth" id="date-of-birth" class="form-control" placeholder="{{ __('Date Of Birth') }}" value="{{ old('date_of_birth') }}">
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="image-input">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="profile_pic" id="image-input" aria-describedby="image-input" value="{{ old('profile_pic') }}" style="cursor: pointer">
                                          <label class="custom-file-label" for="image-input">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select name="office_id" id="select-office" class="form-control">
                                            
                                        </select>
                                    </div>

                                    <div class="form-group">
                                    <select name="role_id" id="select-role" class="form-control">
                                        
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contact_number" placeholder="{{ __('Contact Number') }}" value="{{ old('contact_number') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="address" id="address" placeholder="{{ __('Address') }}" value="{{ old('address') }}" cols="30" rows="3" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Register') }}
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <a href="/home" class="btn btn-secondary btn-user btn-block">Back to Home</a>
                                    </div>
                                </form>

                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            let roles = {!! json_encode($roles->toArray()) !!} // pass the $roles data from blade to jQuery
            let offices = {!! json_encode($offices->toArray()) !!}

            $('.dropdown-item-office').remove()
            $('.dropdown-item-role').remove()
            $('#select-role').append('<option value="" class="dropdown-item-role" selected disabled style="cursor:pointer">Choose Role</option>')
            $('#select-office').append('<option value="" class="dropdown-item-office" selected disabled style="cursor:pointer">Choose Office</option>')
            roles.forEach(role => {
                let list = '<option class="dropdown-item-role" value="' + role.id + '" style="cursor:pointer">' + role.name + '</option>'
                $('#select-role').append(list)
            });

            offices.forEach(office => {
                let list = '<option class="dropdown-item-office" value="' + office.id + '">' + office.name + '</option>'
                $('#select-office').append(list);
            })

            $('input[type="file"]').on('change', function(e){
                let image_name = e.target.files[0].name
                $('.custom-file-label').text(image_name)
            })
        })

        

        // $('#select-role').on('click', function(){
        //     $('.dropdown-item-role').remove()
        //     roles.forEach(role => {
        //         // let list = '<li class="dropdown-item dropdown-item-role" id="selected-item-role" value="' + role.id + '" style="cursor:pointer">' + role.name + '</li>'
        //         // $('#selected-role').append(list)
                
        //     });
        // })
    </script>
@endsection
