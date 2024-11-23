<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Artisan;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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

    public function exportDatabase()
    {
        $databaseName = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT', 3306);
        $fileName = "backup_" . date('Y_m_d_H_i_s') . ".sql";
        $filePath = storage_path($fileName);
        $command = [
            'mysqldump',
            '--host=' . $host,
            '--port=' . $port,
            '--user=' . $username,
            '--password=' . $password,
            $databaseName,
        ];

        $process = new Process($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        file_put_contents($filePath, $process->getOutput());
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
