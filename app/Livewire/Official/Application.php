<?php

namespace App\Livewire\Official;

use Livewire\Component;

use App\Models\Semester;
use Illuminate\Support\Facades\Crypt;

class Application extends Component
{

    public $school_year_from;
    public $school_year_to;

    public function render()
    {
        $semesters = Semester::distinct()->orderBy('created_at', 'ASC')->get(['school_year', 'id','semester','created_at']);
        return view('livewire.official.application', ['semesters' => $semesters]);
    }

    public function addSemester(){
        $this->validate([
            'school_year_from' => 'required|numeric',
            'school_year_to' => 'required|numeric',
        ]);

        try{
            $school_year = $this->school_year_from. '-'.$this->school_year_to;

            $values = [
                [
                    'semester' => 'First Semester',
                    'school_year' => $school_year
                ],
                [
                    'semester' => 'Second Semester',
                    'school_year' => $school_year
                ]
            ];
            Semester::insert($values);
            $this->dispatch('hide_modal');
            session()->flash('error', 'Something went wrong!!');

        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }

    }
}
