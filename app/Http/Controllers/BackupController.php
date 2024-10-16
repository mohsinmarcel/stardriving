<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Artisan;

class BackupController extends Controller
{
    public function view(){
        $files = Storage::allFiles('Star-Driving-School');
        return view('backup.view',compact('files'));
    }
    public function daily(){
        Artisan::call("backup:run --disable-notifications");
        echo 'Scheduler executed at ' . now().PHP_EOL;
        return redirect()->route('database-backup')->with('success','Backup file created successfully');
    }
    public function deleteFile(Request $request){
        Storage::delete($request->filename);
        return response()->json(['status'=>true,'success' => 'Backup file deleted successfully']);
    }
}
