<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function index()
    {   
        $user = User::findOrFail(Auth::user()->id);
        return view('personal.index')->with('user', $user);
    }
}
