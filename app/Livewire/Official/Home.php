<?php

namespace App\Livewire\Official;


use Livewire\Component;
use App\Models\User;
use App\Models\Semester;
use App\Models\Application;

class Home extends Component
{
    public $pending_applicants = null;
    public $approved_applicants = null;

    public function render()
    {
        $user_count = User::where('role', 0)->count();
        $semester = Semester::where('status', 1)->first();

        if($semester){
            $this->pending_applicants = Application::selectRaw('programs.program_abbreviation, COUNT(*) as count')
                                        ->leftJoin('users' ,'applications.id_number', '=', 'users.id_number')
                                        ->leftJoin('programs' ,'users.program', '=', 'programs.id')
                                        ->where('semester_id', $semester->id)
                                        ->whereNot('applications.status', 3)
                                        ->groupBy('programs.program_abbreviation')
                                        ->get();

            $this->approved_applicants = Application::selectRaw('programs.program_abbreviation, COUNT(*) as count')
                                        ->leftJoin('users' ,'applications.id_number', '=', 'users.id_number')
                                        ->leftJoin('programs' ,'users.program', '=', 'programs.id')
                                        ->where('semester_id', $semester->id)
                                        ->where('applications.status', 3)
                                        ->groupBy('programs.program_abbreviation')
                                        ->get();
        }
                    
        return view('livewire.official.home', ['user_count' => $user_count, 'semester' => $semester, 'pending_applicants' => $this->pending_applicants, 'approved_applicants' => $this->approved_applicants]);
    }
}
