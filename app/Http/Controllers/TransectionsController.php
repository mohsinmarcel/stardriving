<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quarters;
use App\Models\Expense;

class TransectionsController extends Controller
{
    public function index()
    {
        $quarters = Quarters::all();
        return view('transections.index', compact('quarters'));
    }

    public function create()
    {
        return view('quarters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date|after:fromdate',
        ]);

        Quarters::create($request->all());

        return response()->json(['status'=>true, 'success'=>"Quarter added sccessfully"]);
    }

    public function show($id)
    {
        $quarter = Quarters::findOrFail($id);
        return view('quarters.show', compact('quarter'));
    }

    public function edit($id)
    {
        $quarter = Quarters::findOrFail($id);
        return view('quarters.edit', compact('quarter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fromdate' => 'required',
            'todate' => 'required',
        ]);

        $quarter = Quarters::findOrFail($id);
        $quarter->update($request->all());

        return redirect()->route('quarters.index')
            ->with('success', 'Quarter updated successfully');
    }

    public function destroy($id)
    {
        $quarter = Quarters::findOrFail($id);
        $quarter->delete();

        return redirect()->route('quarters.index')
            ->with('success', 'Quarter deleted successfully');
    }
}
