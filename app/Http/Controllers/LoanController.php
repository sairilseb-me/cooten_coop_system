<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|numeric',
            'loan_type' => 'required|numeric',
            'loan_amount' => 'required|numeric',
            'reason' => 'required|string'
        ]);

        $loan = Loan::create([
            'applicant_id' => $request->input('user_id'),
            'loan_type_id' => $request->input('loan_type'),
            'loan_request_status' => 0,
            'payment_status' => 0,
            'loan_amount' => $request->input('loan_amount'),
            'date_applied' => date('Y-m-d H:i:s'),
            'reason' => $request->input('reason')
        ]);

        return redirect()->back()->with('success', 'Successfully applied for a loan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }

    public function loanApplications()
    {
        $loans = Loan::with(['user', 'loan_type'])->get();
        return view('loans.application')->with('loans', $loans);
    }
}
