<?php

namespace App\Livewire\Official;

use Livewire\Component;
use App\Models\Application;
use App\Models\Program;
use App\Models\Offices;
use App\Models\Semester;

class Records extends Component
{
    public $semester_id = '';
    public $semester_status;
    public $report_office = '';
    public $report_program = '';

    public $office = '';
    public $program = '';
    public $year_level = '';
    public $search_input = '';
    public $institutes;

    public function mount(){
        $this->institutes = Offices::whereNotIn('id', [1,2])->get();
    }

    public function render()
    {

        $report_institutes = Offices::whereNotIn('id', [1,2])->get();;
        
        if ($this->office != null || $this->office != ''){
            $programs = Program::where('office_id', $this->office)->where('status', 0)->get();
        }else{ 
            $programs = '';
        }

        if ($this->report_office != null || $this->report_office != ''){
            $report_programs = Program::where('office_id', $this->report_office)->where('status', 0)->get();
        }else{ 
            $report_programs = '';
        }

        $semester_list = Semester::get();

        if ($this->semester_id != null || $this->semester_id != ''){
            $current_sem = Semester::where('semesters.id', $this->semester_id)->first();
            $this->semester_status = $current_sem->status;
        }else{
            $current_sem = null;
        }

        $deans_list = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
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
                                    ->where('applications.status', 3)
                                    ->orderBy('applications.equivalent', 'ASC')
                                    ->get(['users.id_number','first_name','last_name', 'offices.office as institute', 'programs.program_name', 'applications.id', 'year_level', 'applications.status', 'grade', 'average', 'equivalent']);

        return view('livewire.official.records', ['semester_list' => $semester_list, 'current_sem' => $current_sem, 'institutes' => $this->institutes, 'programs' => $programs, 'deans_list' => $deans_list, 'report_institutes' => $report_institutes, 'report_programs' => $report_programs]);
    }

    public function generateList(){
        if ($this->report_office == null){
            $this->report_program = null;
        }
        try{
            $deans_list = Application::leftjoin('users', 'applications.id_number', '=', 'users.id_number')
                                    ->leftjoin('offices', 'users.office', '=', 'offices.id')
                                    ->leftjoin('programs', 'users.program', '=', 'programs.id')
                                    ->when($this->report_program, function($query){
                                        $query->where('users.program', $this->report_program);
                                    })
                                    ->when($this->report_office, function($query){
                                        $query->where('users.office', $this->report_office);
                                    })
                                    ->where('semester_id', $this->semester_id)
                                    ->where('applications.status', 3)
                                    ->orderBy('applications.equivalent', 'ASC')
                                    ->count();

            if ($deans_list > 0){
                session()->flash('success', 'Found Deans List!');
            }else{
                session()->flash('fail', 'No Deans List Found!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
