<?php

namespace App\Http\Controllers;

use App\Models\ChargesType;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentExtraCharges;
use Validator;
use Auth;
use DB;
class StudentExtraChargesController extends Controller
{
    public function studentExtraCharges($id){
        $student = Student::findOrFail($id);
        $chargesType = ChargesType::all();
        return view('student-extra-charges.create',compact('student','chargesType'));
    }

    public function getExtraChargesAmount(Request $request){
        $chargesType = ChargesType::findOrFail($request->id);
        return response()->json(['status'=>true,'amount'=>$chargesType->amount]);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'charges_type' => 'required',
            'amount' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $chargesType = ChargesType::findOrFail($request->charges_type);
        $inputs = [
            'charges_type' => $chargesType->name,
            'amount' => $request->amount,
            'student_id'=> $request->student_id,
            'admin_id'=> Auth::id()
        ];
        StudentExtraCharges::create($inputs);
        return response()->json(['status'=>true, 'success'=>"Student Extra Charges added successfully."]);
    }

    

    public function edit($id){
        $extra_charges = StudentExtraCharges::findOrFail($id);
        $chargesType = ChargesType::all();
        return view('student-extra-charges.edit',compact('extra_charges','chargesType'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'charges_type' => 'required',
            'amount' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $chargesType = ChargesType::findOrFail($request->charges_type);
        $student_extra_charges = StudentExtraCharges::findOrFail($request->id);
        $inputs = [
            'charges_type' => $chargesType->name,
            'amount' => $request->amount,
            'admin_id'=> Auth::id()
        ];
        $student_extra_charges->update($inputs);
        return response()->json(['status'=>true, 'success'=>"Student Extra Charges updated successfully."]);
    }

    public function destroy($id){
        $chargesType = StudentExtraCharges::findOrFail($id);

        $extra_charges_remaining_amount = DB::table('student_payments')->select(DB::raw("((select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = ".$chargesType->student_id.")-ifnull(sum(student_payments.amount),0) ) as remaining_amount"))->where("payment_type_id",2)->where("student_id",$chargesType->student_id)->first()->remaining_amount;
        if($extra_charges_remaining_amount >= $chargesType->amount){
            $chargesType->delete();
            return response()->json(['status'=>true, 'success'=>"Student Extra Charges deleted successfully."]);
        }
        return response()->json(['status'=>false, 'error'=>"Cannot delete extra charges, already paid."]);
    }
}
