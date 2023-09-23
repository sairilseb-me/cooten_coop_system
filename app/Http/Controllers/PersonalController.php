<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function index()
    {   
        $user = User::findOrFail(Auth::user()->id);
        $loan_types = LoanType::all();
        $loans = Loan::with('loan_type')->where('applicant_id', auth()->user()->id)->get();
        return view('personal.index')->with(['user' => $user, 'loan_types' => $loan_types, 'loans' => $loans]);
    }
}
