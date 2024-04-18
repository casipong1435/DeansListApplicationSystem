<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Offices;
use App\Models\Program;
use Illuminate\Support\Facades\Crypt;
use PDF;


class OfficialController extends Controller
{
    public function OfficialHome(){
        return view('official.home');
    }

    public function OfficialProfile(){
        return view('official.profile');
    }

    public function OfficialApplication(){
        return view('official.application');
    }

    public function OfficialApplicationinfo($sem, $sy){

        $sem = Crypt::decrypt($sem);
        $sy = Crypt::decrypt($sy);
        return view('official.application-info', ['sem' => $sem, 'sy' => $sy]);
    }

    public function downloadGrade($file){
        $path = storage_path('/app/grade/'.$file);
        return response()->download($path);
    }

    public function RecordSection(){
        return view('official.record');
    }

    public function DownloadDeansList($semester_id, $office = null, $program = null){

        if($program != null){
            $institute = Offices::where('id', $office)->first(['office'])->office;
        }else{
            $institute = '';
        }
        if($program != null){
            $program_name = Program::where('id', $program)->first(['program_name'])->program_name;
        }else{
            $program_name = '';
        }

        $deans_list = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($program, function($query) use ($program){
                                        $query->where('users.program', $program);
                                    })
                                    ->when($office, function($query) use ($office){
                                        $query->where('users.office', $office);
                                    })
                                    ->where('semester_id', $semester_id)
                                    ->where('applications.status', 3)
                                    ->orderBy('applications.equivalent', 'ASC')
                                    ->get(['users.id_number','first_name','last_name','middle_name', 'offices.office as institute', 'programs.program_abbreviation', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        $deanslist = PDF::loadView('pdf.deanslist', ['deans_list' => $deans_list, 'office' => $institute, 'program' => $program_name]);
        //return $conducted_training->download('conducted-training - '.$year.'.pdf');
        return $deanslist->stream('pdf.deanslist');
    }

    
}
