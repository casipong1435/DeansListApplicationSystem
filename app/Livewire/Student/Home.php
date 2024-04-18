<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\User;
use App\Models\Semester;

class Home extends Component
{
    public $user_id;

    public function mount(){
        $this->user_id = auth()->user()->id;
    }

    public function render()
    {
        $user_first_name = User::where('users.id', $this->user_id)->first(['first_name'])->first_name;

        $semester = Semester::where('status', 1)->first();
        return view('livewire.student.home', ['user_first_name' => $user_first_name, 'semester' => $semester]);
    }
}
