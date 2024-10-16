<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Quarters;
use App\Models\Supplier;
use App\Models\StudentPayment;
use App\Models\OverriddenFinancialIncome;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $expenses = Expense::where('quarter_id', $id)
        ->orderBy('created_at', 'desc')
        ->get();
    
        $quarter = Quarters::where('id', $id)->firstOrFail();
        $suppliers = Supplier::all(); 
        return view('expence.index', compact('expenses', 'id', 'quarter', 'suppliers'));
    }

    public function view($id)
    {
        // Retrieve expenses for the selected quarter
        $expenses = Expense::where('quarter_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Retrieve quarter information
        $quarter = Quarters::where('id', $id)->firstOrFail();

        // Retrieve income data for the selected quarter from StudentPayment
        $incomeFromStudentPayment = StudentPayment::whereBetween('payment_date', [$quarter->fromdate, $quarter->todate])
            ->get();

        // Retrieve overridden income data from FinancialIncome
        $overriddenIncome = OverriddenFinancialIncome::where('quarter_id', $id)->first();

        // Calculate total income amounts from StudentPayment
        $totalIncomeWithoutTax = 0;
        $totalIncomeGST = 0;
        $totalIncomeQST = 0;
        $totalIncomeWithTax = 0;

        foreach ($incomeFromStudentPayment as $payment) {
            // Calculate amounts without tax, GST, and QST
            $amountWithoutTax = $payment->amount / 1.14975; // 1 + 0.05 + 0.09975 = 1.14975
            $amountGST = $amountWithoutTax * 0.05;
            $amountQST = $amountWithoutTax * 0.09975;

            // Update total income amounts
            $totalIncomeWithoutTax += $amountWithoutTax;
            $totalIncomeGST += $amountGST;
            $totalIncomeQST += $amountQST;
            $totalIncomeWithTax += $payment->amount;
        }

        // If overridden income data exists, use it instead
        if ($overriddenIncome) {
            $totalIncomeWithoutTax = $overriddenIncome->incomeWithoutTax;
            $totalIncomeGST = $overriddenIncome->incomeGST;
            $totalIncomeQST = $overriddenIncome->incomeQST;
            $totalIncomeWithTax = $overriddenIncome->incomeWithTax;
        }

        // Other data retrieval (if needed)
        $suppliers = Supplier::all();

        return view('expence.view', compact('expenses', 'incomeFromStudentPayment', 'overriddenIncome', 'id', 'quarter', 'suppliers', 'totalIncomeWithoutTax', 'totalIncomeGST', 'totalIncomeQST', 'totalIncomeWithTax'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'date' => 'required|date',
            'quarter_id' => 'required',
            'amount' => 'required|numeric',
            'source' => 'required',
            'description' => 'required',
            'supplier' => 'required',
        ]);

        Expense::create([
            'date' => $request->date,
            'quarter_id' => $request->quarter_id,
            'amount' => $request->amount,
            'source' => $request->source,
            'description' => $request->description,
            'supplier' => $request->supplier,
        ]);

        return redirect()->route('expence.index', ['id' => $id])->with('success', 'Expense added successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$additionalId)
    {
        $quarter = Expense::findOrFail($id);
        $quarter->delete();

        return redirect()->route('expence.index',$additionalId)
            ->with('success', 'Expence deleted successfully');
    }

    public function updateIncome(Request $request, $quarterId)
    {
        try {
            $request->validate([
                'incomeWithoutTax' => 'required|numeric',
                'incomeGST' => 'required|numeric',
                'incomeQST' => 'required|numeric',
                'incomeWithTax' => 'required|numeric',
            ]);
    
            // Find the income record by quarter_id
            $income = OverriddenFinancialIncome::where('quarter_id', $quarterId)->first();
    
            if ($income) {
                // If found, update the existing record
                $income->update([
                    'incomeWithoutTax' => $request->input('incomeWithoutTax'),
                    'incomeGST' => $request->input('incomeGST'),
                    'incomeQST' => $request->input('incomeQST'),
                    'incomeWithTax' => $request->input('incomeWithTax'),
                ]);
            } else {
                // If not found, create a new record
                OverriddenFinancialIncome::create([
                    'quarter_id' => $quarterId,
                    'incomeWithoutTax' => $request->input('incomeWithoutTax'),
                    'incomeGST' => $request->input('incomeGST'),
                    'incomeQST' => $request->input('incomeQST'),
                    'incomeWithTax' => $request->input('incomeWithTax'),
                ]);
            }
    
            return response()->json(['message' => 'Income updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
