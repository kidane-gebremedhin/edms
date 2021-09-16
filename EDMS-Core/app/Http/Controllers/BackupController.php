<?php

namespace App\Http\Controllers;

use Andegna;
use DateTime;
use Illuminate\Http\Request;
use PDO;

class BackupController extends Controller
{
    private $date;

    public function __construct()
    {
      // $this->middleware('ict');
      // parent::__construct();
      $this->date = (new Andegna\DateTime(new DateTime()))->format('Y-m-d');
    }

    // public function index()
    // {   
    //     return view('pages.Admin.reports.excel-exports.index')
    //         ->withZones(Zone::all())
    //         ->withWoredas(Woreda::all());
    // }

    public function backup(Request $request)
    {   
        $old_path = getcwd();
        $shell_path = storage_path().'\shell_scripts';
        chdir($shell_path);
        $output = shell_exec('.\take_backup.sh');
        chdir($old_path);
//'C:\xampp\htdocs\EDMS\EDMS-Core\storage\shell_scripts\take_backup.sh'
        

        \Session::flash('success', 'Backup Successful! Backup has saved to '.env('BACKUP_PATH'));
        \App\Global_var::logAction($request, 'Backup Successful! Backup has saved to '.env('BACKUP_PATH'));

    return redirect()->route("home");

    }


    
}
