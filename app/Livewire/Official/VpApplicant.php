<?php

namespace App\Livewire\Official;

use Livewire\Component;
use App\Models\Application;
use App\Models\Semester;
use App\Models\Offices;
use App\Models\Program;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserNotification;
use Carbon\Carbon;

class VpApplicant extends Component
{
    public $semester;
    public $school_year;
    public $semester_id;
    public $semester_status;

    public $office = '';
    public $program = '';
    public $year_level = '';
    public $search_input = '';

    public function mount($sem, $sy){
        $this->semester = $sem;
        $this->school_year = $sy;
        $this->semester_id = Semester::where('semester', $this->semester)->where('school_year', $this->school_year)->first(['id'])->id;
    }

    public function render()
    {
        $institutes = Offices::whereNotIn('id', [1,2])->get();
        if ($this->office != null || $this->office = ''){
            $programs = Program::where('office_id', $this->office)
                ->get();
        }else{
            $programs = null;
        }
        
        $this->semester_status = Semester::where('id', $this->semester_id)->first(['status'])->status;
        $applicants_need_vp = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->year_level, function($query){
                                        $query->where('users.year_level', $this->year_level);
                                    })
                                    ->when($this->program, function($query){
                                        $query->where('users.program', $this->program);
                                    })
                                    ->when($this->office, function($query){
                                        $query->where('users.office', $this->office);
                                    })
                                    ->when($this->search_input, function($query){
                                        $query->search('users.first_name', $this->search_input);
                                        $query->search('users.last_name', $this->search_input);
                                        $query->search('users.year_level', $this->search_input);
                                        $query->search('offices.office', $this->search_input);
                                        $query->search('programs.program_name', $this->search_input);
                                        $query->search('equivalent', $this->search_input);
                                    })
                                    ->where('semester_id', $this->semester_id)
                                    ->where('applications.status', 2)
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        return view('livewire.official.vp-applicant', ['applicants_need_vp' => $applicants_need_vp, 'programs' => $programs, 'institutes' => $institutes]);
    }

    public function approveApplicant($id){
        $applicant_id = Crypt::decrypt($id);

        try{
            Application::where('id', $applicant_id)->update(['status' => 3, 'vp_date_approved' => Carbon::now('Asia/Manila')]);
            session()->flash('success', 'Application Approved!');

            $user_id = Application::where('id', $applicant_id)->first(['id_number'])->id_number;

            $user = User::where('id_number', $user_id)->first();

            $message = 'Your Application for the '.$this->semester.' S.Y. '.$this->school_year.' have been approved by the VPAA. You are now an official Deans Lister. Congratulations!';
            $heading = 'Congratulations!';
            $url = route('StudentApplication');
    
            $user->notify(new UserNotification($heading, $message, $url));
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
