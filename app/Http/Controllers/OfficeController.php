<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::all();
        return view('admin.offices')->with('offices', $offices);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'office' => 'required|string',
        ]);

        $office = Office::create([
            'name' => $request->input('office'),
        ]);

        return redirect()->back()->with('success', 'Successfully added a new office.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        $validated = $request->validate([
            'office' => 'required|string',
        ]);

        $office->name = $request->input('office');
        $office->update();

        return redirect()->back()->with('success', 'Succesfuly updated an office name.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->back()->with('success', 'Successfully deleted an Office.');
    }
}
