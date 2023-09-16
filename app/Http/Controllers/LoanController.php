<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loan_types = LoanType::all();
        return view('admin.loans')->with('loan_types', $loan_types);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan' => 'required|string',
        ]);

        $loan_type = LoanType::create([
            'name' => $request->input('loan'),
        ]);

        return redirect()->back()->with('success', 'Successfully added new Loan Type.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanType $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanType $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanType $loan)
    {
        $validated = $request->validate([
            'loan' => 'required|string',
        ]);

        $loan->name = $request->input('loan');
        $loan->update();

        return redirect()->back()->with('success', 'Successfully updated a Loan Type.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanType $loan)
    {
        $loan->delete();

        return redirect()->back()->with('success', 'Successfully delete a Loan Type.');
    }
}
