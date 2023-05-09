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
            'toast' => session()->get('toast'),
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
            FinanceRecord::updateOrCreate($validated);
            
            return redirect()->back()->with('toast', ['success', 'The record has been added.']);

            // return to_route('finance.index')->with('test', 'This is a test string');
            // Redirect to the index page with the updated records
            // dd(redirect()->route('finance.index')->with('success', 'Record created successfully.')->with('records', $records));

            return to_route('finance.index');
            return Inertia::location(route('finance.index'));
            // return route('finance.index'); //->with('test', 'Record created successfully.')->with('records', $records);

        } catch (\Throwable $th) {
            return redirect()->back()->with('toast', ['warning', 'The record has NOT been added, pleas try again.']);
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
