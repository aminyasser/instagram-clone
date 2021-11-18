<?php

namespace App\Http\Livewire;

use App\Models\Follow as ModelsFollow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Follow extends Component
{

    public $user_id;
    public $username ;
    public $followExist;
    public $followClass ;
    public $followingCount ;
    public $followersCount ;
    public $user ;
    public $is_profile ;
    public $buttonContent;


    public function mount ($id) {
        $this->user_id = $id;
        $this->user = User::findOrFail($id);
        $this->followExist = DB::table('follows')
        ->where('user_id' ,  Auth::user()->id )
        ->where('follow_id' , $id)->exists();
        $this->followClass = $this->getFollowClass();
        if(Auth::user()->id == $id)
        $this->is_profile = true;
        else $this->is_profile = false;
        $this->followingCount = $this->getFollowingCount();
        $this->followersCount = $this->getFollowersCount();
        $this->buttonContent = $this->getButtonContent();

    }

    public function render()  {
        return view('livewire.follow');
    }
    public function getFollowClass () {
        if($this->followExist)
            return "follow-exist";
        else return "unfollow-exist";
    }
    public function getFollowingCount () {

            return $this->user->followings->count();
    }
    public function getFollowersCount () {

        return $this->user->followers->count();
    }
    public function getButtonContent () {
        if($this->followExist) {
            return "Unfollow";
        } else {
            if($this->user->followBack($this->user_id)) {
                return "Follow Back";
            } else return "Follow";
        }
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
        $this->user = User::find($this->user_id);
        $this->followingCount = $this->getFollowingCount();
        $this->followersCount = $this->getFollowersCount();
        $this->buttonContent = $this->getButtonContent();
        $this->followClass = $this->getFollowClass();
    }

}
