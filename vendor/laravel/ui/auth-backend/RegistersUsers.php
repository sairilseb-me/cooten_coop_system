<?php

namespace Illuminate\Foundation\Auth;

use App\Models\Office;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $roles = Role::all();
        $offices = Office::all();
        return view('auth.register')->with(['roles' => $roles, 'offices' => $offices]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $createUser = $this->create($request->all());

        $file = $request->file('profile_pic');
        $filename = $file->getClientOriginalName();

        $storage = Storage::disk('local');
        
        $path = $storage->putFileAs('public/images/profile', $file, $filename);

        // if($createUser){
        //     session()->flash('success', 'Successfully created a user.');
        //     return view('home');
        // }

        // $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        session()->flash('success', 'Successfully created a user.');

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
