<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Image;
use Storage;

class StudentDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function studentDocumentsCreate($id)
    {
        $student = Student::findOrFail($id);
        $documentType = DocumentType::all();
        return view('student-documents.create',compact('documentType','student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'document_type_id' => [
                'required', 'max:255',
                Rule::unique('student_documents')->where(function ($query) use($request) {
                    return $query->where('student_id', $request->student_id);
                }),
            ],
            'document' => 'required_without:signature_status|mimes:jpeg,jpg,png,pdf|nullable|max:2048',
            // 'signature' => 'required_with:signature_status',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }

        if($request->document_type_id == 5 || $request->document_type_id == 6){
            
            if(!$request->has('signature_status') && $request->document->extension() != 'png'){
                return response()->json(['status'=>false, 'error'=>['document'=>'Signature must be in png format']]);
            }
        }
        $studentDocument = new StudentDocument;
        if($request->signature_status == 1){
            $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
            $file_stream = Image::make(file_get_contents($request->signature))->stream();
            Storage::disk('local')->put($file_name,$file_stream);
        }
        else{
            $file_name = $request->document->store('student_documents');
        }
        if($request->hasFile('document')){
            $file_name = $request->document->store('student_documents');
            $studentDocument->document = $file_name;
        }
        $studentDocument->student_id = $request->student_id;
        $studentDocument->document_type_id = $request->document_type_id;
        $studentDocument->document = $file_name;
        $studentDocument->save();
        return response()->json(['status'=>true, 'success'=>"Student Document added successfully"]);
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
        // $student = Student::all($id);
        $studentDocument = StudentDocument::findOrFail($id);
        $documentType = DocumentType::all();
        return view('student-documents.edit',compact('documentType','studentDocument'));
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
            // 'document' => 'required|mimes:jpeg,jpg,png|nullable|max:2048',
            // 'signature' => 'required_with:signature_status',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $studentDocument = StudentDocument::findOrFail($request->id);
        if($request->signature_status == 1){
            $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
            $file_stream = Image::make(file_get_contents($request->signature))->stream();
            Storage::disk('local')->put($file_name,$file_stream);
        }
        else{
            $file_name = $request->document->store('student_documents');
        }

        Storage::delete($studentDocument->document);
        $studentDocument->document = $file_name;

        if($request->hasFile('document')){
            Storage::delete($studentDocument->document);
            $file_name = $request->document->store('student_documents');
            $studentDocument->document = $file_name;
        }
        $studentDocument->document = $file_name;
        $studentDocument->save();
        return response()->json(['status'=>true, 'success'=>"Student Document updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $studentDocument = StudentDocument::findOrFail($id);
        $student = Student::where('id',$studentDocument->student_id)->first();
        $studentDocument->delete();
        return redirect()->route('students.show',$student->student_id)->with('success','Student Document deleted successfully');
    }
}
