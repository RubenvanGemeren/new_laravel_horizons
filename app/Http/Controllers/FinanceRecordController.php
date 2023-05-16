<?php

namespace App\Http\Controllers;

use App\Models\FinanceRecord;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FinanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        $columns = ['date', 'name', 'type', 'category', 'description', 'amount', 'effective_date'];

        return Inertia::render('Finance', [
            'records' => FinanceRecord::select($columns)->get(),
            'columns' => ['Date', 'Name', 'Type', 'Category', 'Description', 'Amount', 'Effective Date'],
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
            $validated['date'] = date('Y-m-d', strtotime($validated['date']));
            $validated['effective_date'] = date('Y-m-d', strtotime($validated['effective_date']));

            // Create record
            $record = FinanceRecord::updateOrCreate($validated);

            $request->session()->flash('toast', ['success', 'The record ' . '"' . $record->name. '"' . ' has been added!', time()]);

            return redirect()->back();

        } catch (\Throwable $th) {

            $request->session()->flash('toast', ['warning', $th->getMessage(), time()]);

            return redirect()->back();
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
