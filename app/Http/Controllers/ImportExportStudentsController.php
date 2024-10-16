<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\Rate;
use App\Models\SettingDetail;
use Illuminate\Http\Request;
use Excel;
use Auth;
class ImportExportStudentsController extends Controller
{
    public function import(){
        return view('import-export.import');
    }
    public function importPost(Request $request){
        if(!Auth::user()->hasPermissionTo('import')){
            return abort(401);
        }
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx|max:2048'
        ]);
        $theoryClassRate = Rate::where('class_type_id',1)->first();
        $practicalClassRate = Rate::where('class_type_id',2)->first();
        $tax = SettingDetail::join('settings', 'settings.id', '=', 'setting_details.setting_id')->where('settings.slug','tax')->get(['setting_details.key','setting_details.value'])->toArray();
        $taxes = ['gst_tax' => $tax[0]['value'],'qst_tax' => $tax[1]['value']];
        Excel::import(new StudentsImport($theoryClassRate,$practicalClassRate,$taxes), request()->file('import_file'));
        return redirect()->back()->with(['success'=>'Students export successfully.']);
    }
    public function exportStudents(){
        if(!Auth::user()->hasPermissionTo('export')){
            return abort(401);
        }
        return Excel::download(new StudentsExport, 'students_'.date('Y-m-d').'.xlsx');
    }
}
