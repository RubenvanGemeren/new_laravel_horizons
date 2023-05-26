<?php

namespace App\Http\Controllers;

use App\Models\FinanceCategory;
use App\Models\FinanceRecord;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinanceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTableConfig = [
            ['text' => "#", 'value' => 'id', 'sortable' => false],
            ['text' => "Name", 'value' => 'name', 'sortable' => true],
            ['text' => "Description", 'value' => 'description', 'sortable' => true],
            ['text' => "Color", 'value' => 'color', 'sortable' => true],
        ];

        $databaseColumns = array_map(fn ($item) => $item['value'], $dataTableConfig);

        array_push($dataTableConfig, ['text' => "Operation", 'value' => "operation", 'width' => 20]);

        // return $databaseColumns;

        return Inertia::render('Category', [
            'records' => FinanceCategory::select($databaseColumns)->get(),
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
                'name' => ['required', 'max:200'],
                'description' => ['nullable', 'max:500'],
                'color' => ['required', 'max:9', 'starts_with:#'],
            ]);

            // Create record
            $record = FinanceCategory::updateOrCreate($validated);

            $request->session()->flash('toast', ['success', 'Category ' . '"' . $record->name. '"' . ' has been added!', time()]);

            return redirect()->back();

        } catch (\Throwable $th) {

            $request->session()->flash('toast', ['warning', $th->getMessage(), time()]);

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceCategory $financeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceCategory $financeCategory)
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
                'name' => ['required', 'max:200'],
                'description' => ['nullable', 'max:500'],
                'color' => ['required', 'max:9', 'starts_with:#'],
            ]);

            // Update record
            FinanceCategory::find($recordId)->update($validated);

            $request->session()->flash('toast', ['success', 'The category ' . '"' . $validated['name']. '"' . ' has been updated!', time()]);

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

            $category = FinanceCategory::find($recordId);

            // Delete record
            $category->delete();

            // dd(FinanceRecord::where('category_id' , $category->id)->get());

            $relatedFinanceRecords = FinanceRecord::where('category_id' , $category->id)->get();
            // Set all finance records with same id as null
            foreach ($relatedFinanceRecords as $record) {
                $record->update(['category_id' => null]);
            }

            $request->session()->flash('toast', ['error', 
                'The category ' 
                . '"' 
                . $request->name 
                . '"' 
                . ' has been deleted! and ' 
                . $relatedFinanceRecords->count() 
                . ' record(s) have been affected' 
                , time()]);

            return redirect()->back();

        } catch (\Throwable $th) {

            $request->session()->flash('toast', ['warning', $th->getMessage(), time()]);

            return redirect()->back();
        }
    }
}
