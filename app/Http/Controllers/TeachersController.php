<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Auth;
use Image;
use Storage;
class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('teacher-view'))
        {
            return abort(401);
        }
        $teachers = Teacher::all();
        return view('teachers.index',\compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('teacher-create'))
        {
            return abort(401);
        }
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'address' => 'required',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            // 'gender' => 'required',
            // 'signature_image' => 'required_without:signature_status|mimes:png|nullable|max:2048',
            'signature_image' => 'mimes:png|nullable|max:2048',
            'license_number' => 'required|unique:teachers,license_number,NULL,id,deleted_at,NULL',
            // 'signature' => 'required_with:signature_status',
            'license_image' => 'mimes:jpeg,jpg,png|nullable|max:2048',
            'email' => 'nullable|email'
        ]);
        $file_name = null;
        if($request->has('signature_status')){
            $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
            $file_stream = Image::make(file_get_contents($request->signature))->stream();
            Storage::disk('local')->put($file_name,$file_stream);
        }
        else{
            if($request->hasFile('signature_image')){
                $file_name = $request->signature_image->store('signatures');
            }
        }
        $license_image = null;
        if($request->hasFile('license_image')){
            $license_image = $request->license_image->store('teachers_licenses');
        }
        $inputs = array_merge(['license_image'=>$license_image,'signature_image'=>$file_name],$request->except(['_token','signature_image','license_image']));
        Teacher::create($inputs);
        return redirect()->route('teachers.index')->with('success','Teacher created successfully!');
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
        if(!Auth::user()->hasPermissionTo('teacher-edit'))
        {
            return abort(401);
        }
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit',\compact('teacher'));
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'address' => 'required',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            // 'gender' => 'required',
            'signature_image' => 'mimes:jpeg,jpg,png|nullable|max:2048',
            'license_number' => 'required|unique:teachers,license_number,'.$id.',id,deleted_at,NULL',
            'signature' => 'nullable',
            'license_image' => 'mimes:jpeg,jpg,png|nullable|max:2048',
            'email' => 'nullable|email'
        ]);

        $teacher = Teacher::findOrFail($id);
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->address = $request->address;
            $teacher->phone_number = $request->phone_number;
            $teacher->gender = $request->gender;
            $teacher->license_number = $request->license_number;
            $teacher->email = $request->email;
            // $teacher = $request->signature_image;
        
        if($request->hasFile('signature_image') || $request->has('signature')){
            if($request->has('signature_status')){
                $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
                $file_stream = Image::make(file_get_contents($request->signature))->stream();
                Storage::disk('local')->put($file_name,$file_stream);
            }
            else{
                $file_name = $request->signature_image->store('signatures');
            }
            Storage::delete($teacher->signature_image);
            $teacher->signature_image = $file_name;
        }
        $license_image = null;
        if($request->hasFile('license_image')){
            $license_image = $request->license_image->store('teachers_licenses');
            Storage::delete($teacher->license_image);
            $teacher->license_image = $license_image;
        }
        $teacher->save();
        return redirect()->route('teachers.index')->with('success','Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('teacher-delete'))
        {
            return abort(401);
        }
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success','Teacher deleted successfully');
    }
}
