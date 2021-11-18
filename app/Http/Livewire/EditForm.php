<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditForm extends Component
{
    public $name;
    public $email;
    public $username;
    public $gender;
    public $bio;
    public $website;
    public $phone;
    public $user;

    public function mount () {

    $this->user = Auth::user();
    $this->name = $this->user->name;
    $this->email = $this->user->email;
    $this->username = $this->user->username;
    $this->website = $this->user->website;
    $this->gender = $this->user->gender;
    $this->bio = $this->user->bio;
    $this->phone = $this->user->phone;

    }
    public function rules()
    {
        return [
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username,' . Auth::user()->username.',username',
            'email' => 'required|email|unique:users,email,' . Auth::user()->email.',email',
            'bio' => 'max:60',
            'website' => '' ,
            'phone' => '',
            'gender' => ''
        ];
    }


    public function render()
    {
        return view('livewire.edit-form');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit()
    {

       $data = $this->validate();

        $id = Auth::user()->id;
        User::findOrFail($id)->update($data);

    }
}

