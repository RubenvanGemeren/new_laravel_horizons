<?php

namespace App\Http\Controllers;

use App\Models\FinanceRecord;
use App\Models\Income;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return Inertia::render('Finance', [
            'records' => FinanceRecord::get()
        ]);
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
        try {

            $validated = $request->validate([
                'date' => ['required', 'date'],
                'name' => ['required', 'max:200'],
                'type' => ['required', 'string'],
                'category' => ['required', 'string'],
                'description' => ['nullable', 'max:500'],
                'amount' => ['required', 'decimal:0,2'],
                'effective_date' => ['required', 'date'],
            ]);

            // Turn amount to cents
            $validated['amount'] = intval(floatval($validated['amount']) * 100);

            // Turn dates in timetamps
            $validated['date'] = date('Y-m-d H:i:s', strtotime($validated['date']));
            $validated['effective_date'] = date('Y-m-d H:i:s', strtotime($validated['effective_date']));

            // Create record
            FinanceRecord::create($validated);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        } finally {
            // Redirect and hope for toast :P

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        //
    }
}
