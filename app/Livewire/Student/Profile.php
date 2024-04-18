<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{

    public $user_id;

    public function mount(){
        $this->user_id = auth()->user()->id;
    }
    public function render()
    {
        $user_profile = User::leftJoin('offices', 'users.office', '=', 'offices.id')
                            ->leftJoin('programs', 'users.program', '=', 'programs.id')            
                            ->where('users.id', $this->user_id)->first(['first_name', 'last_name', 'middle_name', 'offices.office', 'programs.program_abbreviation', 'email', 'id_number', 'year_level']);
        return view('livewire.student.profile', ['user_profile' => $user_profile]);
    }
}
