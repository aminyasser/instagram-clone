<?php

namespace App\Http\Livewire;

use App\Models\Follow as ModelsFollow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FollowBtn extends Component
{
    public $buttonClass;
    public $user_id;
    public $folowExist;

    public function mount ($id) {

     $this->user_id = $id;
     $this->followExist = DB::table('follows')
     ->where('user_id' ,  Auth::user()->id )
     ->where('follow_id' , $id)->exists();
     $this->buttonContent = $this->getButtonContent();
     $this->buttonClass = $this->getButtonClass();
    }

    public function getButtonContent () {
        if($this->followExist) {
            return "Following";
        } else {
            return "Follow";
        }
    }
    public function getButtonClass () {
        if($this->followExist)
            return "following-class";
        else return "";
    }

    public function click () {
        if(!$this->followExist) {
            $data = [
                'user_id' => Auth::user()->id,
                'follow_id' => $this->user_id
            ];
            ModelsFollow::create($data);
            $this->followExist = true;
        } else {

            ModelsFollow::where('user_id' ,  Auth::user()->id )
            ->where('follow_id' , $this->user_id)->delete();
            $this->followExist = false;
        }
        $this->buttonContent = $this->getButtonContent();
        $this->buttonClass = $this->getButtonClass();

    }
    public function render()
    {
        return view('livewire.follow-btn');
    }
}
