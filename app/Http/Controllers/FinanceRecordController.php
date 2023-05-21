<?php

namespace App\Http\Controllers;

use App\Models\FinanceRecord;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        $dataTableConfig = [
            ['text' => "#", 'value' => 'id', 'sortable' => false],
            ['text' => "Date", 'value' => 'date', 'sortable' => true],
            ['text' => "Name", 'value' => 'name', 'sortable' => true],
            ['text' => "Type", 'value' => 'type', 'sortable' => true],
            ['text' => "Category", 'value' => 'category', 'sortable' => true],
            ['text' => "Description", 'value' => 'description', 'sortable' => true],
            ['text' => "Amount", 'value' => 'amount', 'sortable' => true],
            ['text' => "Effective date", 'value' => 'effective_date', 'sortable' => true],
        ];

        $databaseColumns = array_map(fn ($item) => $item['value'], $dataTableConfig);

        array_push($dataTableConfig, ['text' => "Operation", 'value' => "operation", 'width' => 20]);

        // return $databaseColumns;

        return Inertia::render('Finance', [
            'records' => FinanceRecord::select($databaseColumns)->get(),
            'columns' => $dataTableConfig,
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
    public function show(FinanceRecord $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceRecord $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $recordId)
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

            // Update record
            FinanceRecord::find($recordId)->update($validated);

            $request->session()->flash('toast', ['info', 'The record ' . '"' . $validated['name']. '"' . ' has been updated!', time()]);

            return redirect()->back();

        } catch (\Throwable $th) {

            $request->session()->flash('toast', ['warning', $th->getMessage(), time()]);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $recordId)
    {
        try {
            // Delete record
            FinanceRecord::find($recordId)->delete();

            $request->session()->flash('toast', ['error', 'The record ' . '"' . $request->name. '"' . ' has been deleted!', time()]);

            return redirect()->back();

        } catch (\Throwable $th) {

            $request->session()->flash('toast', ['warning', $th->getMessage(), time()]);

            return redirect()->back();
        }
    }
}
