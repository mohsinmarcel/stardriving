<?php
namespace App\Services;

use App\Constants\DatabaseEnumConstants;
use App\Contracts\ReportContract;
use App\Models\SettingDetail;
use App\Models\Student;
use App\Models\StudentCourseDetail;
use App\Models\StudentDocument;
use App\Models\StudentEvaluation;
use App\Models\StudentEvaluationDetail;
use App\Models\StudentExam;
use App\Models\StudentExamQuestion;
use App\Models\StudentExtraCharges;
use App\Models\StudentPayment;
use App\Models\Teacher;
use Mpdf\Mpdf;
use DB;
use Auth;

class ReportService implements ReportContract{

    public function contractReport($id){
        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));
        $student = Student::join('student_course_details','student_course_details.student_id','students.id')
            ->join('student_contracts','student_contracts.student_id','students.id')
            ->join('student_licenses','student_licenses.student_id','students.id')
            ->select('students.student_id','students.first_name','students.last_name','students.gender','students.dob','students.email','students.phone_number_1','students.phone_number_2','students.address','students.postal_code','students.city','students.province','student_licenses.license_number','student_licenses.certificate_number','student_course_details.theoretical_credit_hours','student_course_details.practical_credit_hours','student_course_details.total_hours','student_course_details.sub_total','student_course_details.remaining_amount','student_course_details.discount','student_course_details.gst_tax','student_course_details.qst_tax','student_contracts.beginning_of_contract','student_contracts.end_of_contract')->where('students.id',$id)->first();
        $student_signature_document = StudentDocument::where('student_id',$id)->where('document_type_id',5)->first();
        if($student_signature_document != null){
            $student_signature =  base64_encode(file_get_contents(public_path().'/storage/'.$student_signature_document->document));
        }else{
            $student_signature = null;
        }

        $parent_signature_document = StudentDocument::where('student_id',$id)->where('document_type_id',6)->first();
        if($parent_signature_document != null){
            $parent_signature =  base64_encode(file_get_contents(public_path().'/storage/'.$parent_signature_document->document));
        }else{
            $parent_signature = null;
        }

        $setting_detail= SettingDetail::where('key','representative_signature_image')->first();
        if($setting_detail != null && $setting_detail->value != '' && $setting_detail->value != null){
            $representative_sign = base64_encode(file_get_contents(public_path().'/storage/'.$setting_detail->value));
        }else{
            $representative_sign = null;
        }

        $data = [
            'image'=> $image,
            'student' => $student,
            'student_signature' => $student_signature,
            'parent_signature' => $parent_signature,
            'representative_sign' => $representative_sign
        ];
        $view_html = view('reports.student-contract', $data)->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($view_html);
        return $mpdf;
    }
    public function sessionEvaluation($id)
    {
        $student_evaluation = StudentEvaluation::findOrFail($id);
        $student_evaluation_strength = StudentEvaluationDetail::where([
            'student_evaluation_id'=>$id,
            "type" => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            "evaluation_by" => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->get();
        $student_evaluation_weaknesses = StudentEvaluationDetail::where([
            'student_evaluation_id'=>$id,
            "type" => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            "evaluation_by" => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->get();
        $instructor_evaluation_strength = StudentEvaluationDetail::where([
            'student_evaluation_id'=>$id,
            "type" => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            "evaluation_by" => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->get();
        $instructor_evaluation_weaknesses = StudentEvaluationDetail::where([
            'student_evaluation_id'=>$id,
            "type" => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            "evaluation_by" => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->get();
        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));
        //$student_signature =  base64_encode(file_get_contents(public_path().'/storage/'.$student_evaluation->student_signature));
        $student_signature = "";
        $student = Student::find($student_evaluation->student_id);
        $teacher = Teacher::find($student_evaluation->teacher_id);
        if(false){ //$teacher!=null
            $teacher_signature =  base64_encode(file_get_contents(public_path().'/storage/'.$teacher->signature_image));
        }else{
            $teacher_signature = null;
        }
        $data = [
            'image'=> $image,
            'student_evaluation' => $student_evaluation,
            'student_signature' => $student_signature,
            'teacher_signature' => $teacher_signature,
            'student_evaluation_strength' => $student_evaluation_strength,
            'student_evaluation_weaknesses' => $student_evaluation_weaknesses,
            'instructor_evaluation_strength' => $instructor_evaluation_strength,
            'instructor_evaluation_weaknesses' => $instructor_evaluation_weaknesses,
            'student' => $student,
            'teacher' => $teacher,
        ];
        $view_html = view('reports.session-evaluation', $data)->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($view_html);
        return  $mpdf;
    }
    public function studentExam($examId){

        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));
        $quebec_image = base64_encode(file_get_contents(public_path().'/assets/report-assets/images/quebec.png'));
        $student_exam = StudentExam::findOrFail($examId);
        $student = Student::findOrFail($student_exam->student_id);
        $student_exam_detail = StudentExamQuestion::join('exam_questions','exam_questions.id','student_exam_questions.exam_question_id')
            ->where('student_exam_id',$examId)->get()->toArray();
        $array_chunk_exam = array_chunk($student_exam_detail,(ceil(count($student_exam_detail)/2)));
        $data = [
            'image'=> $image,
            'student_exam' => $student_exam,
            'quebec_image' => $quebec_image,
            'array_chunk_exam' => $array_chunk_exam,
            'student' => $student,
            'exam_name' => $student_exam->exam->name,
        ];
        $view_html = view('reports.student-exam', $data)->render();
        $mpdf = new Mpdf([
            'useActiveForms' => true
        ]);
        $mpdf->WriteHTML($view_html);
        return $mpdf;
    }
    public function examDeclaration($id)
    {
        $image = base64_encode(file_get_contents(public_path().'/assets/report-assets/images/road-safety.png'));
        $student = StudentExam::join('students','student_exams.student_id','students.id')->find($id);
        $data = [
            'image'=> $image,
            'student' => $student
        ];
        $view_html = view('reports.exam-declaration', $data)->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($view_html);
        return  $mpdf;
    }
    public function studentMedical($id)
    {
        $student_medicals = DB::select("SELECT name,status FROM `student_medical_conditions` join medical_conditions ON medical_conditions.id = student_medical_conditions.medical_condition_id where student_medical_conditions.student_id = ${id}");
        $student_medicals_traverse = [];
        foreach ($student_medicals as $key => $value) {
            $student_medicals_traverse[$value->name] = $value->status;
        }
        $image = base64_encode(file_get_contents(public_path().'/assets/report-assets/images/Capture1.PNG'));
        $data = [
            'image'=> $image,
            'student_medicals' => $student_medicals_traverse
        ];
        $view_html = view('reports.student-medical', $data)->render();
        // $mpdf = new Mpdf();
        $mpdf = new Mpdf([
            'useActiveForms' => true
        ]);
        $mpdf->WriteHTML($view_html);
        return  $mpdf;
    }
    public function studentAttendance($id)
    {
        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));

        $student = Student::join('student_contracts','student_contracts.student_id','students.id')
            ->join('student_licenses','student_licenses.student_id','students.id')
            ->select('students.student_id','students.first_name','students.last_name','students.phone_number_1','students.phone_number_2','student_licenses.license_number','student_licenses.certificate_number','student_licenses.student_condition','student_licenses.license_issuing_date','student_contracts.beginning_of_contract','student_contracts.end_of_contract')->where('students.id',$id)->first();

        $student_attendance = DB::select("select st.id,sad.student_id,TIME_FORMAT(st.start_time,'%h:%i %p') start_time,TIME_FORMAT(st.end_time,'%h:%i %p') end_time,st.attendance_date,st.created_at,ct.id as class_type_id, ct.name class_type,cm.id class_module_id,cm.name class_modules,t.id teacher_id,t.signature_image teacher_signature_image,t.license_number from student_attendances st
        join class_types ct on st.class_type_id = ct.id
        join class_modules cm on st.class_module_id = cm.id
        join teachers t on t.id = st.teacher_id
        join student_attendance_details sad on st.id = sad.student_attendance_id
        where sad.student_id = {$id}");

        $teacher_signs = DB::select("select DISTINCT t.id teacher_id,t.signature_image teacher_signature_image
        from student_attendances st
        join teachers t on t.id = st.teacher_id
        join student_attendance_details sad on st.id = sad.student_attendance_id
        where sad.student_id = {$id}");

        $teacher_signs_traverse = [];

        for($i =0;$i<count($teacher_signs);$i++){
            $teacher_signs_traverse[$teacher_signs[$i]->teacher_id] = base64_encode(file_get_contents(storage_path().'/app/public/'.$teacher_signs[$i]->teacher_signature_image));
        }
        $student_signature_document = StudentDocument::where('student_id',$id)->where('document_type_id',5)->first();
        $student_signature =  ($student_signature_document != null) ? base64_encode(file_get_contents(storage_path().'/app/public/'.$student_signature_document->document)) : null;

        $attendance_traverse = [];
        for($i =0;$i<count($student_attendance);$i++){
            $attendance_traverse[$student_attendance[$i]->class_modules] = $student_attendance[$i];
        }
        $setting_detail= SettingDetail::where('key','representative_signature_image')->first();
        try {
            if ($setting_detail != null && $setting_detail->value != '' && $setting_detail->value != null) {
                $representative_sign = base64_encode(file_get_contents(storage_path() . $setting_detail->value));
            } else {
                $representative_sign = null;
            }
        } catch (\Exception $e) {
            $representative_sign = null;
        }

        $data = [
            'image'=> $image,
            'student' => $student,
            'student_signature' => $student_signature,
            'teacher_signs' => $teacher_signs_traverse,
            'student_attendance' => $attendance_traverse,
            'representative_sign' => $representative_sign
        ];
        // $view_html = view('reports.student-attendance', $data)->render();
        // $mpdf = new Mpdf();
        // $mpdf->WriteHTML($view_html);
        // return  $mpdf;
        $view_html = view('reports.student-attendance', $data)->render();
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // 'L' for landscape orientation
        $mpdf->WriteHTML($view_html);
        return $mpdf;

    }
    public function phaseOneCertificate($id)
    {
        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));
        $student = Student::join('student_contracts','student_contracts.student_id','students.id')
            ->join('student_licenses','student_licenses.student_id','students.id')
            ->select('students.student_id','students.first_name','students.last_name','students.city','students.province','students.postal_code','students.address','students.phone_number_1','students.phone_number_2','student_licenses.license_number','student_licenses.certificate_number','student_licenses.student_condition','student_licenses.license_issuing_date','student_contracts.beginning_of_contract','student_contracts.end_of_contract')->where('students.id',$id)->first();

        $student_attendance = DB::select("select st.attendance_date,cm.name class_modules from student_attendances st
            join class_modules cm on st.class_module_id = cm.id
            join student_attendance_details sad on st.id = sad.student_attendance_id
            where sad.student_id = {$id}");

        $attendance_traverse = [];
        for($i =0;$i<count($student_attendance);$i++){
            $attendance_traverse[$student_attendance[$i]->class_modules] = $student_attendance[$i];
        }

        $setting_detail= SettingDetail::where('key','representative_signature_image')->first();
        if($setting_detail != null && $setting_detail->value != '' && $setting_detail->value != null){
            $representative_sign = base64_encode(file_get_contents(storage_path().'/app/public/'.$setting_detail->value));
        }else{
            $representative_sign = null;
        }

        $bar_code_document= StudentDocument::where('student_id',$id)->where('document_type_id',13)->first();
        if($bar_code_document != null){
            $bar_code_ext = pathinfo($bar_code_document->document, PATHINFO_EXTENSION);
            $bar_code_image = base64_encode(file_get_contents(storage_path().'/app/public/'.$bar_code_document->document));
        }else{
            $bar_code_image = null;
            $bar_code_ext = null;
        }
        $student_signature_document = StudentDocument::where('student_id',$id)->where('document_type_id',5)->first();
        $student_signature =  ($student_signature_document != null) ? base64_encode(file_get_contents(storage_path().'/app/public/'.$student_signature_document->document)) : null;
        $data = [
            'image'=> $image,
            'student' => $student,
            'attendance_traverse' => $attendance_traverse,
            'representative_sign' => $representative_sign,
            'student_signature' => $student_signature,
            'bar_code_image' => $bar_code_image,
            'bar_code_ext' => $bar_code_ext
        ];
        $view_html = view('reports.phase-one-certificate', $data)->render();
        $mpdf = new Mpdf([
            'useActiveForms' => true
        ]);

        $mpdf->WriteHTML($view_html);
        $mpdf->SetHTMLFooter('
            <table width="100%" style="vertical-align: bottom; font-family: calibri;
                font-size: 8pt; color: #000000;margin-top:0px">
                <tr>
                    <td style="text-align:center">
                    Formulaire prescrit par l’AQTR pour la réussite du cours de conduite dans une école reconnues <br>
                    <span style="color:red;text-align:center;font-weight:bold">COPIE DE L\'ÉLÈVE (Phase 1 - Véhicule de Promenade)</span>
                    </td>
                </tr>
            </table>');
        return  $mpdf;
    }
    public function finalCertificate($id)
    {
        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));
        $student = Student::join('student_contracts','student_contracts.student_id','students.id')
            ->join('student_licenses','student_licenses.student_id','students.id')
            ->select('students.student_id','students.first_name','students.last_name','students.city','students.province','students.postal_code','students.address','students.phone_number_1','students.phone_number_2','student_licenses.license_number','student_licenses.certificate_number','student_licenses.student_condition','student_licenses.license_issuing_date','student_contracts.beginning_of_contract','student_contracts.end_of_contract')->where('students.id',$id)->first();

        $student_attendance = DB::select("select st.attendance_date,cm.name class_modules from student_attendances st
            join class_modules cm on st.class_module_id = cm.id
            join student_attendance_details sad on st.id = sad.student_attendance_id
            where sad.student_id = {$id}");

        $attendance_traverse = [];
        for($i =0;$i<count($student_attendance);$i++){
            $attendance_traverse[$student_attendance[$i]->class_modules] = $student_attendance[$i];
        }

        $setting_detail= SettingDetail::where('key','representative_signature_image')->first();
        $setting_representative_name = SettingDetail::where('key','representative_name')->first();
        $representative_name = $setting_representative_name != null?$setting_representative_name->value:null;
        if($setting_detail != null && $setting_detail->value != '' && $setting_detail->value != null){
            $representative_sign = base64_encode(file_get_contents(storage_path().'/app/public/'.$setting_detail->value));
        }else{
            $representative_sign = null;
        }

        $bar_code_document= StudentDocument::where('student_id',$id)->where('document_type_id',13)->first();
        if($bar_code_document != null){
            $bar_code_ext = pathinfo($bar_code_document->document, PATHINFO_EXTENSION);
            $bar_code_image = base64_encode(file_get_contents(storage_path().'/app/public/'.$bar_code_document->document));
        }else{
            $bar_code_image = null;
            $bar_code_ext = null;
        }

        $student_signature_document = StudentDocument::where('student_id',$id)->where('document_type_id',5)->first();
        $student_signature =  ($student_signature_document != null) ? base64_encode(file_get_contents(storage_path().'/app/public/'.$student_signature_document->document)) : null;
        $data = [
            'image'=> $image,
            'student' => $student,
            'attendance_traverse' => $attendance_traverse,
            'representative_sign' => $representative_sign,
            'student_signature' => $student_signature,
            'representative_name' => $representative_name,
            'bar_code_image' => $bar_code_image,
            'bar_code_ext' => $bar_code_ext,
        ];
        $view_html = view('reports.final-certificate', $data)->render();
        $mpdf = new Mpdf([
            'useActiveForms' => true
        ]);
        $chunks = explode("chunk", $view_html);
        foreach($chunks as $key => $val) {
            $mpdf->WriteHTML($val);
        }
        return  $mpdf;
    }
    public function invoice($id){
        $image = base64_encode(file_get_contents(public_path().'/assets/images/Logo-02.png'));
        $student = Student::where('id',$id)->select(
            'students.first_name',
            'students.last_name',
            'students.address',
            'students.phone_number_1',
            'students.email',
            'students.student_id'
        )->firstOrFail();
        $student_payment = StudentPayment::where('student_id',$id)->get();
        $total_payment = StudentPayment::where('student_id',$id)->sum('amount');
        $student_total_extra_charges = StudentExtraCharges::where('student_id',$id)->sum('amount');
        $student_extra_charges = StudentExtraCharges::where('student_id',$id)->select('student_extra_charges.amount','student_extra_charges.charges_type')->get();
        $student_course_detail = StudentCourseDetail::where('student_id',$id)->first();
        $sub_total = $student_total_extra_charges + $student_course_detail->sub_total;
        $extra_charges_sub_total = $student_total_extra_charges;
        $course_sub_total = $student_course_detail->sub_total;
        $gst_amount = round(($student_course_detail->gst_tax/100)*$student_course_detail->sub_total,2);
        $qst_amount = round(($student_course_detail->qst_tax/100)*$student_course_detail->sub_total,2);
        $total_amount = $student_total_extra_charges + $student_course_detail->sub_total + $qst_amount + $gst_amount;
        $data = [
            'image'=> $image,
            'student' => $student,
            'student_payment' => $student_payment,
            'sub_total' => $sub_total,
            'extra_charges_sub_total' => $extra_charges_sub_total,
            'course_sub_total' => $course_sub_total,
            'gst_amount' => $gst_amount,
            'qst_amount' => $qst_amount,
            'total_amount' => $total_amount,
            'total_payment' => $total_payment,
            'discount' => $student_course_detail->discount,
            'student_extra_charges' => $student_extra_charges
        ];
        $view_html = view('reports.invoice', $data)->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($view_html);
        return  $mpdf;
    }
}
