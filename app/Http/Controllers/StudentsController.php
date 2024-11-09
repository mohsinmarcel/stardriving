<?php

namespace App\Http\Controllers;

use App\Constants\DatabaseEnumConstants;
use App\Models\ActivityLog;
use App\Models\ChargesType;
use App\Models\ClassModule;
use App\Models\DocumentType;
use App\Models\EvaluationType;
use Illuminate\Http\Request;
use App\Models\MedicalCondition;
use App\Models\PaymentMethod;
use App\Models\Rate;
use App\Models\SettingDetail;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentContract;
use App\Models\StudentCourseDetail;
use App\Models\StudentDocument;
use App\Models\StudentEvaluation;
use App\Models\StudentEvaluationDetail;
use App\Models\StudentExam;
use App\Models\StudentExtraCharges;
use App\Models\StudentLicense;
use App\Models\StudentMedicalCondition;
use App\Models\StudentNote;
use App\Models\StudentPayment;
use App\Models\Teacher;
use App\Rules\Discount;
use App\Models\Location;
use App\Models\Template;
use Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Image;
use URL;
use File;
use Session;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo('student-view'))
        {
            $students = Student::where('isextrastudent', false)->get();
            return view('students.index',\compact('students'));
        }
        else
        {
            return abort(401);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('student-create'))
        {
            return abort(401);
        }
        $conditions = MedicalCondition::where('active' , 1)->get();
        $payment_methods = PaymentMethod::where('active',1)->get();
        $rate = Rate::all()->toArray();
        $tax = SettingDetail::join('settings', 'settings.id', '=', 'setting_details.setting_id')->where('settings.slug','tax')->get(['setting_details.key','setting_details.value'])->toArray();
        $taxes = ['gst_tax' => $tax[0]['value'],'qst_tax' => $tax[1]['value']];
        session()->put('taxes',$taxes);
        $rates = ['theoretical_rate' => $rate[0]['hourly_rate'], 'practical_rate' => $rate[1]['hourly_rate']];

        $locations = Location::all();


        return view('students.create',compact('conditions','payment_methods','taxes','rates', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theoryClassRate = Rate::where('class_type_id',1)->first();
        $practicalClassRate = Rate::where('class_type_id',2)->first();
        $taxes = session()->get('taxes');
        $request->validate([
            'student_id' => 'required|unique:students,student_id,NULL,id,deleted_at,NULL',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date|before:today',
            'phone_number_1' => 'nullable|regex:/^[0-9]{10}$/',
            'phone_number_2' => 'nullable|regex:/^[0-9]{10}$/',
            'email' => 'nullable|email|unique:students,email,NULL,id,deleted_at,NULL',
            'status_in_canada' => 'nullable|string|max:120',
            'address' => 'nullable|string|max:200',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:200',
            'provine' => 'nullable|string|max:200',
            'student_status' => 'required',
            'certificate_number' => 'nullable|string|max:50',
            'license_number' => 'nullable|required_with:license_issuing_date|required_with:license_expiry_date|string|max:50',
            'license_issuing_date' => 'nullable|date|required_with:license_number',
            'license_expiry_date' => 'nullable|date|after:license_issuing_date|required_with:license_number',
            'student_condition' => 'nullable|string',
            'theoretical_class_hours' => 'required|numeric|min:0|max:'.$theoryClassRate->no_of_hours,
            'practical_class_hours' => 'required|numeric|min:0|max:'.$practicalClassRate->no_of_hours,
            // 'discount' => 'present|exclude_if:discount_type,price|max:100|numeric',
            // 'discount' => 'present|exclude_if:discount_type,percent|numeric|max:'.$request->total_amount,
            'discount' => ['nullable','numeric',new Discount($taxes)],
            // 'payment_date' => 'required|date',
            // 'amount' => 'numeric|min:0|max:'.$request->total_amount,
            // 'cheque_image' => 'nullable|required_if:payment_method,==,cheque|mimes:jpeg,jpg,png,pdf|max:2048',
            // 'credit_card' => 'nullable|required_if:payment_method,==,credit_card|integer|digits_between:16,16',
            // 'debit_card' => 'nullable|required_if:payment_method,==,debit_card|integer|digits_between:4,4',
            'beginning_of_contract' => 'nullable|date',
            'end_of_contract' => 'nullable|date|after:beginning_of_contract'
        ]);
        $file_name = null;
        try{
            DB::beginTransaction();
            $student = Student::create([
                'student_id' => $request->student_id,
                'first_name' => ucfirst($request->first_name),
                'last_name' => ucfirst($request->last_name),
                'gender' => $request->gender,
                'dob' => $request->date_of_birth,
                'email' => $request->email,
                'phone_number_1' => $request->phone_number_1,
                'phone_number_2' => $request->phone_number_2,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'province' => $request->province,
                'status_in_canada' => $request->status_in_canada,
                'is_live_in_canada' => $request->status_in_canada == null?0:1,
                'is_medical_condition' => $request->has('is_medical_condition')?1:0,
                'student_type' => $request->student_status,
                'student_status' => 'enrolled',
                'theroy_exam_date' => $request->theroy_exam_date,
                'theroy_test_location' => $request->theroy_test_location,
                'theroy_test_time' => $request->theroy_test_time,
                'knowledge_test_date' => $request->knowledge_test_date,
                'knowledge_test_time' =>$request->knowledge_test_time,
                'knowledge_test_location' => $request->knowledge_test_location,
            ]);
            // $encodedData    = urlencode(URL::to('/')."/students/".$student->student_id);
            // $response       = Http::get('https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl='.$encodedData);
            // $qrCodeBase64   = 'data:image/png;base64,' . base64_encode($response->body());

            // $student->qr_code_image = $qrCodeBase64;
            //  $student->save();
            // $encodedData = urlencode(URL::to('/') . "/students/" . $student->student_id);
            // $response = Http::get("https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$encodedData}");
            // $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($response->body());

            // $student->qr_code_image = $qrCodeBase64;
            // $student->save();

            $encodedData = urlencode(URL::to('/') . "/students/" . $student->student_id);
            $response = Http::withoutVerifying()->get("https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$encodedData}");
                $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($response->body());

                $student->qr_code_image = $qrCodeBase64;
                $student->save();

            $medicalConditions = MedicalCondition::where('active',1)->get();
            foreach ($medicalConditions as $key => $value) {
                $a = 'medical_condition_'.$value->id;
                StudentMedicalCondition::create([
                    "student_id" => $student->id,
                    "medical_condition_id" => $value->id,
                    "status" => $request->$a == 'yes'?1:0
                ]);
            }
            StudentLicense::create([
                'student_id' => $student->id,
                'certificate_number' => $request->certificate_number,
                'license_number' => $request->license_number,
                'license_issuing_date' => $request->license_issuing_date,
                'license_expiry_date' => $request->license_expiry_date,
                'student_condition' => $request->student_condition
            ]);
            StudentCourseDetail::create([
                'theoretical_credit_hours'=> $request->theoretical_class_hours,
                'practical_credit_hours'=> $request->practical_class_hours,
                'total_hours'=> $request->theoretical_class_hours + $request->practical_class_hours,
                'practical_credit_hours_rates'=> $theoryClassRate->hourly_rate,
                'theoretical_credit_hours_rates'=> $practicalClassRate->hourly_rate,
                'sub_total'=> $request->subtotal,
                'gst_tax'=> $taxes['gst_tax'],
                'qst_tax'=> (float)$taxes['qst_tax'],
                'discount'=> ($request->has('discount') && $request->discount != '')?$request->discount:0,
                'discount_type'=> ($request->has('discount') && $request->discount != '')?$request->discount_type:'none',
                'total_amount'=> $request->total_amount,
                'remaining_amount' => $request->total_amount,
                'student_id' => $student->id
            ]);
            // $paymentMethodId = PaymentMethod::where('key',$request->payment_method)->first()->id;

            // if($request->hasFile('cheque_image') && $request->payment_method == 'cheque')
            // {
            //     $file_name = $request->cheque_image->store('cheques');
            // }
            // StudentPayment::create([
            //     'student_id' => $student->id,
            //     'payment_method_id' => $paymentMethodId,
            //     'payment_date' => $request->payment_date,
            //     'amount' => $request->amount,
            //     'additional_notes' => $request->additional_notes,
            //     'credit_card' => $request->credit_card,
            //     'debit_card' => $request->debit_card,
            //     'cheque_image' => $file_name,
            //     'admin_id' => Auth::id()
            // ]);
            StudentContract::create([
                'student_id' => $student->id,
                'beginning_of_contract' => $request->beginning_of_contract,
                'end_of_contract' => $request->end_of_contract
            ]);
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
            if($file_name != null)
            Storage::delete($file_name);
            // return abort(500);
            throw $ex;
        }
        return redirect()->route('students.index')->with('success','Student created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('student-profile')){
            return abort(401);
        }
        // $students = Student::findOrFail($id);
        $students = Student::where('student_id',$id)->firstOrFail();
        $studentMedicalCondition = StudentMedicalCondition::where('student_id',$students->id)->get();
        $studentLicenses = StudentLicense::where('student_id',$students->id)->first();
        $studentCourseDetails = StudentCourseDetail::where('student_id',$students->id)->first();
        $studentContract = StudentContract::where('student_id',$students->id)->first();
        $studentPayment = StudentPayment::where('student_id',$students->id)->get();
        $studentDocuments = StudentDocument::where('student_id',$students->id)->get();
        $driverLicenseImage = StudentDocument::where('document_type_id',1)->where('student_id',$students->id)->first();
        $documentType = DocumentType::all();
        $chargesTypes = ChargesType::all();
        $studentExtraCharges = StudentExtraCharges::where('student_id',$students->id)->get();
        $studentExams = StudentExam::where('student_id',$students->id)->get();
        $studentNote = StudentNote::where('student_id',$students->id)->get();
        $studentEvaluation = StudentEvaluation::where('student_id',$students->id)->get();
        $student_attendances = StudentAttendance::join('student_attendance_details','student_attendance_details.student_attendance_id','student_attendances.id')->where('student_attendance_details.student_id',$students->id)->get();
        $class_modules = ClassModule::where('active',1)->get()->toArray();
        $extra_charges_remaining_amount = DB::table('student_payments')->select(DB::raw("((select ifnull(sum(student_extra_charges.amount),0) from student_extra_charges where student_id = ".$students->id.")-ifnull(sum(student_payments.amount),0) ) as remaining_amount"))->where("payment_type_id",2)->where("student_id",$students->id)->first()->remaining_amount;
        $totalExtraCharges = DB::table('student_extra_charges')->select(DB::raw("ifnull(sum(student_extra_charges.amount),0) total_amount"))->where("student_id" , $students->id)->first()->total_amount;
        $remaining_hours = DB::select("
        select sum(student_course_details.practical_credit_hours) - (select (count(*))  from  student_attendances join student_attendance_details on student_attendances.id = student_attendance_details.student_attendance_id
        where student_attendances.class_type_id = 2 and student_attendance_details.student_id = {$students->id}) as remaining_driving_hours,sum(student_course_details.theoretical_credit_hours) - (select (count(*)*2)  from  student_attendances join student_attendance_details on student_attendances.id = student_attendance_details.student_attendance_id
        where student_attendances.class_type_id = 1 and student_attendance_details.student_id = {$students->id}) as remaining_theoritical_hours
        from student_course_details where student_id = {$students->id}");

        $template = Template::all();

        return view('students.show',compact('students','template','student_attendances','class_modules','studentLicenses','studentCourseDetails','studentContract','studentPayment','studentDocuments','chargesTypes','studentExtraCharges','studentExams','studentNote','extra_charges_remaining_amount','totalExtraCharges','studentEvaluation','documentType','driverLicenseImage','studentMedicalCondition','remaining_hours'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('student-edit')){
            return abort(401);
        }
        $conditions = MedicalCondition::where('active' , 1)->get();
        $students = Student::findOrFail($id);
        $studentLicenses = StudentLicense::where('student_id',$students->id)->first();
        $studentCourseDetail = StudentCourseDetail::where('student_id',$students->id)->first();
        $tax = SettingDetail::join('settings', 'settings.id', '=', 'setting_details.setting_id')->where('settings.slug','tax')->get(['setting_details.key','setting_details.value'])->toArray();
        $taxes = ['gst_tax' => $tax[0]['value'],'qst_tax' => $tax[1]['value']];
        session()->put('taxes',$taxes);
        $studentContract = StudentContract::where('student_id',$students->id)->first();
        $studentDocuments = StudentDocument::where('student_id',$students->id)->first();
        $studentMedicalCondition = StudentMedicalCondition::where('student_id',$students->id)->get();

        $locations = Location::all();

        return view('students.edit',compact('students','conditions','studentLicenses','studentCourseDetail','taxes','studentContract','studentDocuments','studentMedicalCondition','locations'));
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
        // dd($request->all());
        $theoryClassRate = Rate::where('class_type_id',1)->first();
        $practicalClassRate = Rate::where('class_type_id',2)->first();
        $taxes = session()->get('taxes');
        $request->validate([
            'student_id' => 'required|max:50|string|unique:students,student_id,'.$id.',id,deleted_at,NULL',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date|before:today',
            'phone_number_1' => 'nullable|regex:/^[0-9]{10}$/',
            'phone_number_2' => 'nullable|regex:/^[0-9]{10}$/',
            'email' => 'nullable|email|unique:students,email,'.$id.',id,deleted_at,NULL',
            'status_in_canada' => 'nullable|string|max:120',
            'address' => 'nullable|string|max:200',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:200',
            'provine' => 'nullable|string|max:200',
            'student_status' => 'required',
            'discount' => ['nullable','numeric',new Discount($taxes)],
            'certificate_number' => 'nullable|string|max:50',
            'license_number' => 'nullable|required_with:license_issuing_date|required_with:license_expiry_date|string|max:50',
            'license_issuing_date' => 'nullable|date|required_with:license_number',
            'license_expiry_date' => 'nullable|date|after:license_issuing_date|required_with:license_number',
            'student_condition' => 'nullable|string',
            'theoretical_class_hours' => 'required|numeric|min:0|max:'.$theoryClassRate->no_of_hours,
            'practical_class_hours' => 'required|numeric|min:0|max:'.$practicalClassRate->no_of_hours,
            'beginning_of_contract' => 'nullable|date',
            'end_of_contract' => 'nullable|date|after:beginning_of_contract',
            'driver_license' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'bar_code' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'transfer_certificate' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'final_certificate' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'student_signature_image' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'parent_signature_image' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'other_document_1' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'other_document_2' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
            'refugee_document' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048'
        ]);

        $files = [];
        $student = Student::findOrFail($id);
        try{
            DB::beginTransaction();
            $oldFiles = [];
            $student->update([
                'student_id' => $request->student_id,
                'first_name' => ucfirst($request->first_name),
                'last_name' => ucfirst($request->last_name),
                'gender' => $request->gender,
                'dob' => $request->date_of_birth,
                'email' => $request->email,
                'phone_number_1' => $request->phone_number_1,
                'phone_number_2' => $request->phone_number_2,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'province' => $request->province,
                'status_in_canada' => $request->status_in_canada,
                'is_live_in_canada' => $request->status_in_canada == null?0:1,
                'student_type' => $request->student_status,
                'theroy_exam_date' => $request->theroy_exam_date,
                'theroy_test_location' => $request->theroy_test_location,
                'theroy_test_time' => $request->theroy_test_time,
                'knowledge_test_date' => $request->knowledge_test_date,
                'knowledge_test_time' =>$request->knowledge_test_time,
                'knowledge_test_location' => $request->knowledge_test_location,
            ]);

            $encodedData = urlencode(URL::to('/') . "/students/" . $student->student_id);
            $response = Http::withoutVerifying()->get("https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$encodedData}");
                $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($response->body());

                $student->qr_code_image = $qrCodeBase64;
                $student->update();


            $studentLicense = StudentLicense::where('student_id',$id)->first();
            $studentLicense->update([
                'certificate_number' => $request->certificate_number,
                'license_number' => $request->license_number,
                'license_issuing_date' => $request->license_issuing_date,
                'license_expiry_date' => $request->license_expiry_date,
                'student_condition' => $request->student_condition
            ]);
            $studentMedicalCondition = StudentMedicalCondition::where('student_id',$id)->get();
            foreach ($studentMedicalCondition as $key => $value) {
                $a = 'medical_condition_'.$value->id;
                $value->update([
                    "status" => $request->$a == 'yes'?1:0
                ]);
            }
            $studentContract = StudentContract::where('student_id',$id)->first();
            $studentContract->update([
                'beginning_of_contract' => $request->beginning_of_contract,
                'end_of_contract' => $request->end_of_contract
            ]);
            $studentCourseDetail = StudentCourseDetail::where('student_id',$id)->first();
            $studentPaidAmount = StudentPayment::where('student_id',$id)->sum('amount');
            $remainingAmount = $request->total_amount - $studentPaidAmount;
            if($remainingAmount < 0)
            {
                return redirect()->back()->withInput()->with('error','Can\'t update student discount .Already Paid "'.$studentPaidAmount.'".');
            }
            $studentCourseDetail->update([
                'discount'=> ($request->has('discount') && $request->discount != '')?$request->discount:0,
                'discount_type'=> ($request->has('discount') && $request->discount != '')?$request->discount_type:'none',
                'total_amount'=> $request->total_amount,
                'remaining_amount'=> $remainingAmount
            ]);
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            foreach ($files as  $value) {
                Storage::delete($value);
            }
            throw $ex;
            // return abort(500);
        }
        return redirect()->route('students.show', ['student' => $student->student_id])->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('student-delete'))
        {
            return abort(401);
        }
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully');
    }

    public function studentStatuschange(Request $request){
        $student = Student::findOrFail($request->student_id);
        $student->student_status = DatabaseEnumConstants::STUDENT_STATUSES[$request->student_status];
        $student->save();
        $auth_user = Auth::user()->full_name;
        ActivityLog::create([ 'message' => "Student <b>{$student->student_id}</b> status changed to \"<b>{$student->student_status}</b>\" by \"<b>{$auth_user}</b>\""]);
        return response()->json(['status' => true,"success"=>"Status changed successfully."]);
    }

    public function blukQrCodeImageDownload()
    {
        $students = Student::where('deleted_at',null)->get();
        if(count($students)==0){
            return redirect()->route('students.index')->with('error','There is no student data right now');//->download
        }
        Storage::deleteDirectory("Star-Driving-School-Qrcodes");
        foreach ($students as $student) {
            Storage::put("Star-Driving-School-Qrcodes/student - ".$student->student_id.".png", $student->qr_code_image);
        }
        // dd($students);
        $zip = new \ZipArchive();
        $fileName = 'blukQrCodeImage.zip';
        File::delete(public_path($fileName));
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {
            $files = File::files(public_path("storage/Star-Driving-School-Qrcodes"));
            // dd($files);
            foreach ($files as $key => $value){
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }
        Session::flash('download.in.the.next.request', 'blukQrCodeImage.zip');

        return redirect()->route('students.index')->with('success','Starting Student QrCode Downloading');//->download(public_path($fileName));

    }
}
