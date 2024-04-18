<?php

namespace App\Livewire\Official;

use Livewire\Component;
use App\Models\User;
use App\Models\Application;
use App\Models\Offices;
use App\Models\Program;
use App\Models\Semester;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class ApplicationInfo extends Component
{
    public $table_content = 0;
    //Filters Evaluation
    public $search_input = '';
    public $institute_filter = '';
    public $program_filter = '';
    public $year_filter = '';

    public $semester;
    public $school_year;
    public $semester_id;
    public $office;
    public $semester_status;

    public $id_number;
    public $applicant_office;
    public $program;
    public $year;
    public $average;
    public $name;
    public $year_level;
    public $equivalent;

    public $application_id;

    public $heading;
    public $message;
    public $url;

    public function mount($sem, $sy){
        $this->semester = $sem;
        $this->school_year = $sy;
        $this->semester_id = Semester::where('semester', $this->semester)->where('school_year', $this->school_year)->first(['id'])->id;
        $this->office = auth()->user()->office;
        $this->url = route('StudentApplication');
    }

    public function render()
    {

        $institutes = Offices::whereNotIn('id', [1,2])->get();
        if ($this->institute_filter != null || $this->institute_filter = ''){
            $programs = Program::where('office_id', $this->institute_filter)
                                ->where('programs.status', 0)
                                ->get();
        }else{
            $programs = null;
        }

        $this->semester_status = Semester::where('id', $this->semester_id)->first(['status'])->status;
        $applicants_need_evaluation = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->year_filter, function($query){
                                        $query->where('users.year_level', $this->year_filter);
                                    })
                                    ->when($this->program_filter, function($query){
                                        $query->where('users.program', $this->program_filter);
                                    })
                                    ->when($this->institute_filter, function($query){
                                        $query->where('users.office', $this->institute_filter);
                                    })
                                    ->when($this->search_input, function($query){
                                        $query->search('users.first_name', $this->search_input);
                                        $query->search('users.last_name', $this->search_input);
                                        $query->search('users.year_level', $this->search_input);
                                        $query->search('offices.office', $this->search_input);
                                        $query->search('programs.program_name', $this->search_input);
                                        $query->search('equivalent', $this->search_input);
                                    })
                                    ->where('applications.status', 0)
                                    ->where('semester_id', $this->semester_id)
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        $applicants_need_dean = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->year_filter, function($query){
                                        $query->where('users.year_level', $this->year_filter);
                                    })
                                    ->when($this->program_filter, function($query){
                                        $query->where('users.program', $this->program_filter);
                                    })
                                    ->when($this->institute_filter, function($query){
                                        $query->where('users.office', $this->institute_filter);
                                    })
                                    ->when($this->search_input, function($query){
                                        $query->search('users.first_name', $this->search_input);
                                        $query->search('users.last_name', $this->search_input);
                                        $query->search('users.year_level', $this->search_input);
                                        $query->search('offices.office', $this->search_input);
                                        $query->search('programs.program_name', $this->search_input);
                                        $query->search('equivalent', $this->search_input);
                                    })
                                    ->where('applications.status', 1)
                                    ->where('semester_id', $this->semester_id)
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        $applicants_need_vp = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->year_filter, function($query){
                                        $query->where('users.year_level', $this->year_filter);
                                    })
                                    ->when($this->program_filter, function($query){
                                        $query->where('users.program', $this->program_filter);
                                    })
                                    ->when($this->institute_filter, function($query){
                                        $query->where('users.office', $this->institute_filter);
                                    })
                                    ->when($this->search_input, function($query){
                                        $query->search('users.first_name', $this->search_input);
                                        $query->search('users.last_name', $this->search_input);
                                        $query->search('users.year_level', $this->search_input);
                                        $query->search('offices.office', $this->search_input);
                                        $query->search('programs.program_name', $this->search_input);
                                        $query->search('equivalent', $this->search_input);
                                    })
                                    ->where('applications.status', 2)
                                    ->where('semester_id', $this->semester_id)
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        $applicants_approved = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->year_filter, function($query){
                                        $query->where('users.year_level', $this->year_filter);
                                    })
                                    ->when($this->program_filter, function($query){
                                        $query->where('users.program', $this->program_filter);
                                    })
                                    ->when($this->institute_filter, function($query){
                                        $query->where('users.office', $this->institute_filter);
                                    })
                                    ->when($this->search_input, function($query){
                                        $query->search('users.first_name', $this->search_input);
                                        $query->search('users.last_name', $this->search_input);
                                        $query->search('users.year_level', $this->search_input);
                                        $query->search('offices.office', $this->search_input);
                                        $query->search('programs.program_name', $this->search_input);
                                        $query->search('equivalent', $this->search_input);
                                    })
                                    ->where('applications.status', 3)
                                    ->where('semester_id', $this->semester_id)
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        $applicants_rejected = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->year_filter, function($query){
                                        $query->where('users.year_level', $this->year_filter);
                                    })
                                    ->when($this->program_filter, function($query){
                                        $query->where('users.program', $this->program_filter);
                                    })
                                    ->when($this->institute_filter, function($query){
                                        $query->where('users.office', $this->institute_filter);
                                    })
                                    ->when($this->search_input, function($query){
                                        $query->search('users.first_name', $this->search_input);
                                        $query->search('users.last_name', $this->search_input);
                                        $query->search('users.year_level', $this->search_input);
                                        $query->search('offices.office', $this->search_input);
                                        $query->search('programs.program_name', $this->search_input);
                                        $query->search('equivalent', $this->search_input);
                                    })
                                    ->where('applications.status', 4)
                                    ->where('semester_id', $this->semester_id)
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);
        return view('livewire.official.application-info', ['applicants_need_evaluation' => $applicants_need_evaluation, 'applicants_need_dean' => $applicants_need_dean, 'applicants_need_vp' => $applicants_need_vp, 'applicants_approved' => $applicants_approved, 'applicants_rejected' => $applicants_rejected, 'institutes' => $institutes, 'programs' => $programs]);
    }

    public function modifyApplication($state){

        $state = Crypt::decrypt($state);


        $all_users = User::where('role', 0)->get();
        $this->heading = 'Announcement!';
        

        try{

            switch($state){
                case 0:
                    Semester::where('id', $this->semester_id)->update(['status' => 0]);
                    session()->flash('success', 'Application Canceled!');
                    break;
                case 1:
                    Semester::where('id', $this->semester_id)->update(['status' => 1]);
                    session()->flash('success', 'Application have started!');
                    $this->message = 'Deans List Application for the '.$this->semester.' S.Y. '.$this->school_year.' has now started. Apply Now!';
                    foreach($all_users as $user){
                        $user->notify(new UserNotification($this->heading, $this->message, $this->url));
                    }
                    break;
                case 2:
                    Semester::where('id', $this->semester_id)->update(['status' => 2]);
                    session()->flash('success', 'Application Ended!');

                    $this->message = 'Deans List Application for the '.$this->semester.' S.Y. '.$this->school_year.' has ended!';
                    foreach($all_users as $user){
                        $user->notify(new UserNotification($this->heading, $this->message, $this->url));
                    }
                    break;
            }   

            
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
        
    }
    public function getUserIDNumber($id){
        $this->application_id = Crypt::decrypt($id);

        $application = Application::leftJoin('users', 'users.id_number', '=', 'applications.id_number')
                                    ->leftJoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftJoin('programs', 'users.program', '=', 'programs.id')
                                    ->where('applications.id', $this->application_id)
                                    ->first(['first_name', 'last_name', 'offices.office as institute', 'programs.program_name', 'year_level', 'applications.average', 'applications.id_number']);

        $this->name = $application->first_name.' '.$application->last_name;
        $this->applicant_office = $application->institute;
        $this->id_number = $application->id_number;
        $this->program = $application->program_name;
        $this->year_level = $application->year_level;
        $this->average = $application->average;
        
    }

    public function evaluateApplicant(){
        $this->validate(['equivalent' => 'required']);

        try{
            Application::where('id', $this->application_id)->update(['status' => 1, 'equivalent' => $this->equivalent, 'registrar_date_approved' => Carbon::now('Asia/Manila')]);
            $this->dispatch('hide_modal');
            session()->flash('success', 'Application Evaluated!');

            $this->message = 'Your GWA for the '.$this->semester.' S.Y. '.$this->school_year.' has reached the requirement for Deans List. Congratulations!';
            $this->heading = 'Update!';

            $this->notifyUser($this->application_id, $this->heading, $this->message, $this->url);

        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }

    public function notifyUser($application_id, $heading, $message, $url){
        $user_id = Application::where('id', $application_id)->first(['id_number'])->id_number;

        $user = User::where('id_number', $user_id)->first();

        $user->notify(new UserNotification($heading, $message, $url));
    }

    public function rejectApplicant(){
        $this->validate(['equivalent' => 'required']);

        try{
            Application::where('id', $this->application_id)->update(['status' => 4, 'equivalent' => $this->equivalent]);
            $this->dispatch('hide_modal');
            session()->flash('success', 'Applicant Rejected!');

            $this->message = 'Your GWA for the '.$this->semester.' S.Y. '.$this->school_year.'has not reached the requirement for Deans List. Strive more for the next Sem!';
            $this->heading = 'Sorry!';

            $this->notifyUser($this->application_id, $this->heading, $this->message, $this->url);
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
    
}
