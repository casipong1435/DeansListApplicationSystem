<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Semester;
use App\Models\User;
use App\Models\Application;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class MyApplication extends Component
{
    use WithFileUploads;

    public $semester_id = '';
    public $id_number;
    public $semester_status;

    public $office;
    public $program;
    public $year;
    public $grade;
    public $average;
    public $name;
    public $year_level;

    public function mount(){
        $this->id_number = auth()->user()->id_number;
        $this->userInfo();
    }

    public function render()
    {
        $semester_list = Semester::get();

        if ($this->semester_id != null || $this->semester_id != ''){
            $current_sem = Semester::where('semesters.id', $this->semester_id)->first();
            $this->semester_status = $current_sem->status;
            $current_application = Application::where('semester_id', $this->semester_id)->where('id_number', $this->id_number)->first();
        }else{
            $current_sem = null;
            $current_application = null;
        }

        return view('livewire.student.my-application', ['semester_list' => $semester_list, 'current_sem' => $current_sem, 'current_application' => $current_application]);
    }

    public function userInfo(){
        $user_data = User::leftJoin('offices', 'users.office', '=', 'offices.id')->leftJoin('programs', 'users.program', '=', 'programs.id')->where('id_number', $this->id_number)->first(['first_name', 'last_name', 'offices.office as institute', 'programs.program_name', 'year_level']);

        $this->name = $user_data->first_name.' '.$user_data->last_name;
        $this->office = $user_data->institute;
        $this->program = $user_data->program_name;
        $this->year_level = $user_data->year_level;
    }


    public function applyDeansList(){
        $this->validate([
            'grade' => 'required|mimes:pdf',
            'average' => 'required'
        ]);

        try{
            $application_exist = Application::where('semester_id', $this->semester_id)->where('id_number')->first();

           if(!$application_exist){

                $fileName = uniqid().'.'.$this->grade->getClientOriginalExtension();

                $values = [
                    'semester_id' => $this->semester_id,
                    'id_number' => $this->id_number,
                    'average' => $this->average,
                    'grade' => $fileName,
                    'status' => 0
                ];

                Application::create($values);
                $this->grade->storeAs('grade', $fileName);
                session()->flash('success', 'Successfully Applied for Deans List!');
                $this->dispatch('hide_modal');
           }else{
            session()->flash('exist', 'Already Applied!!');
           }
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
