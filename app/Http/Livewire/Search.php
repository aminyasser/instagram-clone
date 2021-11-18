<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{

    public $search ="";

    public function render()
    {
     
        if($this->search != "")
            $data['users'] =User::where('username' , 'like' , '%'.$this->search.'%')->get();
        else $data['users'] = collect(new User);

        return view('livewire.search')->with($data);
    }
}
