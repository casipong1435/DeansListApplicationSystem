<?php

namespace App\Livewire\Admin;
use App\Models\User;
use App\Models\Offices;
use App\Models\Program;
use Illuminate\Support\Facades\Crypt;
use Hash;

use Livewire\Component;

class Account extends Component
{
    public $isEdit = false;
    public $user_id;
    public $username;
    public $id_number;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $email;
    public $plain_password;
    public $password;
    public $confirm_password;
    public $office = '';
    public $program = '';
    public $search_input;


    public function render()
    {
        $users = User::leftJoin('offices', 'users.office', '=', 'offices.id')
                        ->leftJoin('programs', 'users.program', '=', 'programs.id')
                        ->when($this->search_input, function($query){
                            $query->search('first_name', $this->search_input)
                            ->search('first_name', $this->search_input)
                            ->search('middle_name', $this->search_input)
                            ->search('last_name', $this->search_input)
                            ->search('username', $this->search_input)
                            ->search('offices.office', $this->search_input)
                            ->search('programs.program_name', $this->search_input)
                            ->search('email', $this->search_input)
                            ->search('plain_password', $this->search_input);
                        })
                        ->whereNot('role', 2)
                        ->get(['first_name', 'last_name', 'username', 'email', 'role', 'plain_password', 'offices.office', 'programs.program_name', 'users.id']);

        $offices = Offices::get();
        $programs = Program::when($this->office, function($query){
            $query->where('office_id', $this->office);
        })
        ->where('programs.status', 0)
        ->get();
        
        return view('livewire.admin.account', ['users' => $users, 'offices' => $offices, 'programs' => $programs]);
    }

    public function resetFields(){
        $this->username = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->middle_name = '';
        $this->email = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->office = '';
        $this->program = '';
    }

    public function editState(){
        if($this->isEdit){
            $this->isEdit = false;
            $this->getUserInfo(Crypt::encrypt($this->user_id));
        }else{
            $this->isEdit = true;
        }
        
    }

    public function getUserInfo($id){
        $decrypted_id = Crypt::decrypt($id);
        $this->user_id = $decrypted_id;

        $user_info = User::where('users.id', $decrypted_id)
                        ->first(['first_name', 'last_name', 'middle_name', 'email', 'plain_password', 'office', 'program', 'id_number']);

        $this->id_number = $user_info->id_number;
        $this->first_name = $user_info->first_name;
        $this->last_name = $user_info->last_name;
        $this->middle_name = $user_info->middle_name;
        $this->email = $user_info->email;
        $this->plain_password = $user_info->plain_password;
        $this->office = $user_info->office;
        $this->program = $user_info->program;
    }

    public function editAccount(){

        try{
            $values = [
                'id_number' => $this->id_number,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'email' => $this->email,
                'plain_password' => $this->plain_password,
                'office' => $this->office,
                'program' => $this->program
            ];

            User::where('id', $this->user_id)->update($values);
            session()->flash('success', 'Successfully Updated!');
            $this->isEdit = false;
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!!');
        }
    }

    public function addUser(){

        $this->validate([
            'username' => 'required|min:5|unique:users,username',
            "password" => 'min:8|required_with:confirm_password|same:confirm_password',
            "confirm_password" => 'required',
            'office' => 'required'
        ]);

        try{

            $values = [
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'plain_password' => $this->password,
                'office' => $this->office,
                'program' => $this->program,
                'role' => 1
            ];

            User::create($values);
            session()->flash('register', 'Successfully Updated!');
            $this->dispatch('hide_modal');
        }catch(\Exception $e){
            session()->flash('fail', 'Something Went Wrong!!');
        }
    }

    public function getUserID($id){
        $this->user_id = Crypt::decrypt($id);
    }

    public function deleteUser(){
        try{

            User::where('id', $this->user_id)->delete();
            session()->flash('register', 'Successfully Deleted!');
            $this->dispatch('hide_modal');
        }catch(\Exception $e){
            session()->flash('fail', 'Something Went Wrong!!');
        }
    }
}
