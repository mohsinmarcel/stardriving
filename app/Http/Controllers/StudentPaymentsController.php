<?php

namespace App\Http\Controllers;

use App\Constants\DatabaseEnumConstants;
use App\Mail\PaymentReciept;
use App\Models\ActivityLog;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentCourseDetail;
use App\Models\StudentPayment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;
use Str;
class StudentPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isSearch = false;
        $startDate = null;
        $endDate = null;
    
        if (count($request->all()) > 0) {
            $isSearch = true;
    
            $validator = Validator::make($request->all(), [
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date|after:from_date',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->with(['isSearch' => $isSearch])->withErrors($validator)->withInput();
            }
    
            if ($request->date_range == 'custom') {
                $startDate = $request->from_date;
                $endDate = $request->to_date;
            } else {
                $endDate = now();
                $startDate = now()->subDays($request->date_range);
            }
        }else{
            $endDate = now();
                $startDate = now()->subDays(30);
        }
        $unpaid_students = DB::select("
            select
            students.id,
            students.student_id,
            CONCAT(students.first_name ,' ',students.last_name) as name,
            ifnull((select sum(student_payments.amount) from student_payments where student_payments.student_id = students.id),0) as paid_amount,
            (student_course_details.remaining_amount + (select (select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = students.id)-ifnull(sum(student_payments.amount),0) from student_payments where student_payments.payment_type_id = 2 and student_id = students.id)) as remaining_amount,
            student_course_details.total_amount + (select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_extra_charges.student_id = students.id) as total_amount
            from students join student_course_details
            on
            students.id = student_course_details.student_id
            where students.deleted_at IS NULL
            group by students.id
            having remaining_amount > 0
        ");
        $total_students = DB::select("
        select
        students.id,
        students.student_id,
        CONCAT(students.first_name ,' ',students.last_name) as name,
        ifnull((select sum(student_payments.amount) from student_payments where student_payments.student_id = students.id),0) as paid_amount,
        (student_course_details.remaining_amount + (select (select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = students.id)-ifnull(sum(student_payments.amount),0) from student_payments where student_payments.payment_type_id = 2 and student_id = students.id)) as remaining_amount,
        student_course_details.total_amount + (select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_extra_charges.student_id = students.id) as total_amount
        from students join student_course_details
        on
        students.id = student_course_details.student_id
        where students.deleted_at IS NULL
        group by students.id
        ");
        $paid_students = DB::select("
        select
        students.id,
        students.student_id,
        CONCAT(students.first_name ,' ',students.last_name) as name,
        ifnull((select sum(student_payments.amount) from student_payments where student_payments.student_id = students.id),0) as paid_amount,
        (student_course_details.remaining_amount + (select (select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = students.id)-ifnull(sum(student_payments.amount),0) from student_payments where student_payments.payment_type_id = 2 and student_id = students.id)) as remaining_amount,
        student_course_details.total_amount + (select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_extra_charges.student_id = students.id) as total_amount
        from students join student_course_details
        on
        students.id = student_course_details.student_id
        where students.deleted_at IS NULL
        group by students.id
        having remaining_amount <= 0
        ");
        $studentPayemntsSearch = StudentPayment::join('students', 'students.id', 'student_payments.student_id')
        ->whereNull('students.deleted_at');

    if ($startDate != '' && $endDate != '') {
        $studentPayemntsSearch->whereBetween('student_payments.payment_date', [$startDate, $endDate]);
    }

    if ($startDate != '' && $endDate == '') {
        $studentPayemntsSearch->where('student_payments.payment_date', '>=', $startDate);
    }

    $studentPayemntsSearch = $studentPayemntsSearch->select("student_payments.*")
        ->orderBy('student_payments.payment_date', 'DESC')
        ->get();

    $from_date = $startDate;
    $to_date = $endDate;
    $date_range = $request->date_range;

    session()->put('isSearch', $isSearch);

    return view('student-payments.index', compact('unpaid_students', 'total_students', 'paid_students', 'studentPayemntsSearch', 'isSearch', 'startDate', 'endDate', 'from_date', 'to_date','date_range'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payment_methods = PaymentMethod::where('active',1)->get();
        $stduent_course_detail = StudentCourseDetail::where('student_id',base64_decode($request->id))->firstOrFail();
        $payment_type = PaymentType::all();
        $extra_charges_remaining_amount = DB::table('student_payments')->select(DB::raw("((select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = ".base64_decode($request->id).")-ifnull(sum(student_payments.amount),0) ) as remaining_amount"))->where("payment_type_id",2)->where("student_id",base64_decode($request->id))->first()->remaining_amount;
        return view('student-payments.create',compact('payment_methods','stduent_course_detail','payment_type','extra_charges_remaining_amount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $stduent_course_detail = StudentCourseDetail::where('student_id',base64_decode($request->student_id))->firstOrFail();
        $extra_charges_remaining_amount = DB::table('student_payments')->select(DB::raw("((select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = ".base64_decode($request->student_id).")-ifnull(sum(student_payments.amount),0) ) as remaining_amount"))->where("payment_type_id",2)->where("student_id",base64_decode($request->student_id))->first()->remaining_amount;
        $max_amount = $request->payment_type == '2'?$extra_charges_remaining_amount:$stduent_course_detail->remaining_amount;
        $student = Student::find(base64_decode($request->student_id));
        $validator = Validator::make($request->all(),[
            'payment_method' => 'required',
            'payment_date' => 'required|date|before:tomorrow',
            'payment_type' => 'required',
            'amount' => 'numeric|min:0.01|max:'.$max_amount,
            'cheque_image' => 'nullable|required_if:payment_method,==,cheque|mimes:jpeg,jpg,png,pdf|max:2048',
            'card_type' => 'nullable|required_if:payment_method,==,credit_card|string',
            'credit_card' => 'nullable|required_if:payment_method,==,credit_card|integer|digits_between:4,4',
            'debit_card' => 'nullable|required_if:payment_method,==,debit_card|integer|digits_between:4,4',
            'recieved_by' => 'required',
        ]);
        if ($validator->passes()) {
            $file_name = null;
            try{
                DB::beginTransaction();
                $paymentMethodId = PaymentMethod::where('key',$request->payment_method)->first()->id;

                if($request->hasFile('cheque_image') && $request->payment_method == 'cheque')
                {
                    $file_name = $request->cheque_image->store('cheques');
                }
                StudentPayment::create([
                    'student_id' => base64_decode($request->student_id),
                    'payment_method_id' => $paymentMethodId,
                    'payment_date' => $request->payment_date,
                    'payment_type_id' => $request->payment_type,
                    'amount' => $request->amount,
                    'additional_notes' => $request->additional_notes,
                    'card_type' => $request->card_type,
                    'credit_card' => $request->credit_card,
                    'debit_card' => $request->debit_card,
                    'cheque_image' => $file_name,
                    'recieved_by' => $request->recieved_by,
                    'admin_id' => Auth::id()
                ]);
                if($request->payment_type == '1'){
                    $stduent_course_detail->remaining_amount = $stduent_course_detail->remaining_amount - $request->amount;
                    $stduent_course_detail->save();
                }
                DB::commit();
                if($request->has('send_mail') && $student->email != null && $request->payment_type == '1'){
                    try{
                        $mail_data = [
                            "student_id" => $student->student_id,
                            "student_name" => $student->full_name,
                            "payment_date" => $request->payment_date,
                            "amount" => $request->amount,
                            "payment_method" => Str::title(Str::replace('_', ' ', $request->payment_method)),
                            "balance_amount" => $stduent_course_detail->remaining_amount
                        ];
                        Mail::to($student->email)->send(new PaymentReciept($mail_data));
                    }catch(\Throwable $ex){
                        ActivityLog::create([
                            'message' => "Email Sending: <b>Failed</b>. Email: <b>{$student->email}</b>. Error Message: Invalid email address or mail server not responding."
                        ]);
                    }
                }
                return response()->json(['status'=>true,'message'=>"Payment Added Successfully"]);
            }catch(Exception $ex){
                DB::rollBack();
                if($file_name != null)
                Storage::delete($file_name);
                // return abort(500);
                throw $ex;
            }
        }else{
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
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
        $id = base64_decode($id);
        $student_payment = StudentPayment::with('student','payment_method','payment_type')->findOrFail($id);
        $payment_methods = PaymentMethod::where('active',1)->get();
        $stduent_course_detail = StudentCourseDetail::where('student_id',$student_payment->student_id)->firstOrFail();
        $payment_type = PaymentType::all();
        $extra_charges_remaining_amount = DB::table('student_payments')->select(DB::raw("((select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = ".$student_payment->student_id.")-ifnull(sum(student_payments.amount),0) ) as remaining_amount"))->where("payment_type_id",2)->where("student_id",$student_payment->student_id)->first()->remaining_amount;
        return view('student-payments.edit',compact('student_payment','payment_methods','stduent_course_detail','payment_type','extra_charges_remaining_amount'));
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
        $validator = Validator::make($request->all(),[
            'payment_method' => 'required',
            'payment_date' => 'required|date|before:tomorrow',
            'payment_type' => 'required',
            'amount' => 'numeric|min:0.01',
            'recieved_by' => 'required',
            'cheque_image' => 'nullable|required_if:payment_method,==,cheque|mimes:jpeg,jpg,png,pdf|max:2048',
            'card_type' => 'nullable|required_if:payment_method,==,credit_card|string',
            'credit_card' => 'nullable|required_if:payment_method,==,credit_card|integer|digits_between:4,4',
            'debit_card' => 'nullable|required_if:payment_method,==,debit_card|integer|digits_between:4,4',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        $student_payment = StudentPayment::findOrFail($request->id);
        $stduent_course_detail = StudentCourseDetail::where('student_id',base64_decode($request->student_id))->firstOrFail();
        $extra_charges_remaining_amount = DB::table('student_payments')->select(DB::raw("((select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = ".base64_decode($request->student_id).")-ifnull(sum(student_payments.amount),0) ) as remaining_amount"))->where("payment_type_id",2)->where("student_id",base64_decode($request->student_id))->first()->remaining_amount;
        $max_amount = $request->payment_type == '2'?$extra_charges_remaining_amount:$stduent_course_detail->remaining_amount;
        $max_amount += $student_payment->amount;
        $file_name = null;
            try{
                if($max_amount < $request->amount){
                    return response()->json(['status'=>false,'error'=>['amount' => 'Amount is must be less than or equal to remaining amount.']]);
                }
                DB::beginTransaction();
                $paymentMethodId = PaymentMethod::where('key',$request->payment_method)->first()->id;

                if($request->hasFile('cheque_image') && $request->payment_method == 'cheque'){
                    $file_name = $request->cheque_image->store('cheques');
                }
                $student_payment->update([
                    'payment_method_id' => $paymentMethodId,
                    'payment_date' => $request->payment_date,
                    'payment_type_id' => $request->payment_type,
                    'amount' => $request->amount,
                    'additional_notes' => $request->additional_notes,
                    'card_type' => $request->card_type,
                    'credit_card' => $request->credit_card,
                    'debit_card' => $request->debit_card,
                    'cheque_image' => $file_name,
                    'recieved_by' => $request->recieved_by,
                    'admin_id' => Auth::id()
                ]);
                if($request->payment_type == '1'){
                    $stduent_course_detail->remaining_amount = $max_amount - $request->amount;
                    $stduent_course_detail->save();
                }
                DB::commit();
                // if($request->has('send_mail') && $student->email != null && $request->payment_type == '1'){
                //     try{
                //         $mail_data = [
                //             "student_id" => $student->student_id,
                //             "student_name" => $student->full_name,
                //             "payment_date" => $request->payment_date,
                //             "amount" => $request->amount,
                //             "payment_method" => Str::title(Str::replace('_', ' ', $request->payment_method)),
                //             "balance_amount" => $stduent_course_detail->remaining_amount
                //         ];
                //         Mail::to($student->email)->send(new PaymentReciept($mail_data));
                //     }catch(\Throwable $ex){
                //         ActivityLog::create([
                //             'message' => "Email Sending: <b>Failed</b>. Email: <b>{$student->email}</b>. Error Message: Invalid email address or mail server not responding."
                //         ]);
                //     }
                // }
                return response()->json(['status'=>true,'message'=>"Payment Updated Successfully"]);
            }catch(Exception $ex){
                DB::rollBack();
                if($file_name != null)
                Storage::delete($file_name);
                // return abort(500);
                throw $ex;
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_payment = StudentPayment::findOrFail($id);

        try {
            DB::beginTransaction();
            if($student_payment->payment_type->type == DatabaseEnumConstants::PAYMENT_TYPE_COURSE){
                $amount = $student_payment->amount;
                $student_course_detail = StudentCourseDetail::where('student_id',$student_payment->student_id)->first();
                $student_course_detail->remaining_amount += $amount;
                $student_course_detail->save();
            }
            $student_payment->delete();
            DB::commit();
        } catch (Exception $th) {
            //throw $th;
            return abort(500);
            DB::rollBack();
        }
        return redirect()->back();
        // return response()->json(["status"=>true,"message"=> "Student Payment deleted successfully."]);
    }

    public function studentPayment($id){
        $students = Student::findOrFail($id);
        $studentPayments = StudentPayment::where('student_id',$id)->orderBy('payment_date','DESC')->get();
        return view('student-payments.student_payments',compact('studentPayments'));
    }
    public function sendReceiptEmail(Request $request){
        $student_payment = StudentPayment::findOrFail($request->id);
        $stduent_course_detail = StudentCourseDetail::where('student_id',$student_payment->student_id)->firstOrFail();
        try{
            $mail_data = [
                "student_id" => $student_payment->student->student_id,
                "student_name" => $student_payment->student->full_name,
                "payment_date" => $student_payment->payment_date,
                "amount" => $student_payment->amount,
                "payment_method" => $student_payment->payment_method->name,
                "balance_amount" => $stduent_course_detail->remaining_amount
            ];
            Mail::to($student_payment->student->email)->send(new PaymentReciept($mail_data));
        }catch(\Throwable $ex){
            throw $ex;
            ActivityLog::create([
                'message' => "Email Sending: <b>Failed</b>. Email: <b>{$student_payment->student->email}</b>. Error Message: Invalid email address or mail server not responding."
            ]);
            return response()->json(['status'=>false,'message' => 'Payment Receipt Send failed.']);
        }
        return response()->json(['status'=>true,'message' => 'Payment Receipt Sent successfully.']);
    }
}
