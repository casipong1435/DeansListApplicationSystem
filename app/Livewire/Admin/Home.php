<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Home extends Component
{
    public function render()
    {

        $user_count = User::where('role', 0)->count();

        $users_per__institute = User::selectRaw('programs.program_abbreviation, COUNT(*) as count')
                                            ->leftJoin('programs' ,'users.program', '=', 'programs.id')
                                            ->where('role', 0)
                                            ->groupBy('programs.program_abbreviation')
                                            ->get();

        return view('livewire.admin.home', ['user_count' => $user_count, 'users_per__institute' => $users_per__institute]);
    }
}
