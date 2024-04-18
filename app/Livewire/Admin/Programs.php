<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Offices;
use App\Models\Program;
use Illuminate\Support\Facades\Crypt;

class Programs extends Component
{

    public $institute_id = '';
    public $program_id;
    public $new_program;
    public $program_abbreviation;
    public $program_status = '';


    public function render()
    {
        $institutes = Offices::whereNotIn('id', [1,2])->get();
        $institute_name = Offices::when($this->institute_id, function($query){
            $query->where('id', $this->institute_id);
        })->first(['office'])->office;
        $programs = Program::leftJoin('offices', 'programs.office_id', '=', 'offices.id')
                            ->where('office_id', $this->institute_id)
                            ->when($this->program_status, function($query){
                                $query->where('programs.status', $this->program_status);
                            })
                            ->get(['programs.id', 'programs.program_name', 'offices.office', 'program_abbreviation', 'programs.status']);
        return view('livewire.admin.programs', ['programs' => $programs, 'institutes' => $institutes, 'institute_name' => $institute_name]);
    }

    public function addProgram(){
        $this->validate([
            'new_program' => 'required',
            'program_abbreviation' => 'required'
        ]);

        try{
            $values = [
                'office_id' => $this->institute_id,
                'program_name' => $this->new_program,
                'program_abbreviation' => $this->program_abbreviation
            ];

            Program::create($values);
            $this->resetFields();
            session()->flash('add', 'New Program Added to the Institute!');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');

        }
    }

    public function resetFields(){
        $this->new_program = '';
        $this->program_abbreviation = '';
    }

    public function getProgramID($id){
        $this->program_id = Crypt::decrypt($id);


        $program_info = Program::where('id', $this->program_id)->first(['program_name', 'program_abbreviation']);
        $this->new_program = $program_info->program_name;
        $this->program_abbreviation = $program_info->program_abbreviation;
    }


    public function SaveChanges(){
        $this->validate([
            'new_program' => 'required',
            'program_abbreviation' => 'required'
        ]);

        try{
            $values = [
                'program_name' => $this->new_program,
                'program_abbreviation' => $this->program_abbreviation
            ];

            Program::where('id', $this->program_id)->update($values);
            $this->dispatch('hide_modal');
            session()->flash('success', 'Changes Saved!');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');

        }
    }

    public function archiveProgram(){
        try{
            Program::where('id', $this->program_id)->update(['status' => 1]);
            $this->dispatch('hide_modal');
            session()->flash('archived', 'Program Archived!');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');

        }
    }

    public function UnarchiveProgram($id){
        $this->program_id = Crypt::decrypt($id);

        try{
            Program::where('id', $this->program_id)->update(['status' => 0]);
            $this->dispatch('hide_modal');
            session()->flash('archived', 'Program Unarchived!');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');

        }
    }


}
