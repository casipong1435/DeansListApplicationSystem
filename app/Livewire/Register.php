<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Offices;
use App\Models\Program;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class Register extends Component
{
    public $first_name;
    public $last_name;
    public $middle_name;
    public $id_number;
    public $institute = '';
    public $email;
    public $program = '';
    public $password;
    public $username;
    public $year_level = '';
    public $confirm_password;

    public function render()
    {
        $offices = Offices::whereNotIn('id', [1, 2])->get();
        $programs = Program::where('office_id', $this->institute)->where('status', 0)->get();
        
        return view('livewire.register', ['offices' => $offices, 'programs' => $programs]);
    }

    public function resetFields(){
        $this->first_name = '';
        $this->last_name = '';
        $this->middle_name = '';
        $this->id_number = '';
        $this->institute = '';
        $this->email = '';
        $this->program = '';
        $this->password = '';
        $this->username = '';
        $this->year_level = '';
        $this->confirm_password = '';
    }

    public function Register(){
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:5|unique:users,username',
            'id_number' => 'required|min:3|numeric|unique:users,id_number',
            'first_name' => 'required',
            'last_name' => 'required',
            'institute' => 'required',
            'program' => 'required',
            "password" => 'min:8|required_with:confirm_password|same:confirm_password',
            "confirm_password" => 'required',
            "year_level" => 'required|numeric',
        ]);

        try{

            $NewAccount= [
                'username' => $this->username,
                'email' => $this->email,
                'office' => $this->institute,
                'password' => Hash::make($this->password),
                'plain_password' => $this->password,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'id_number' => $this->id_number,
                'program' => $this->program,
                'year_level' => $this->year_level
                
            ];

            User::create($NewAccount);
            session()->flash('success', 'Registration Successfull!');
            $this->resetFields();

        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!!');
        }
    }
}
