<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reaction extends Component
{
    public $likebuttonClass;
    public $savebuttonClass;
    public $post_id;
    public $likeExist;
    public $saveExist;
    public $likesCount ;
    public $post;
    public function mount ($id) {
        $this->post_id = $id;
        $this->likeExist = DB::table('likes')
        ->where('user_id' ,  Auth::user()->id )
        ->where('post_id' , $id)->exists();
        $this->saveExist = DB::table('saves')
        ->where('user_id' ,  Auth::user()->id )
        ->where('post_id' , $id)->exists();
        $this->likebuttonClass = $this->getLikeButtonClass();
        $this->savebuttonClass = $this->getSaveButtonClass();
        $this->likesCount = $this->countLikes();
        $data = Post::findOrFail($id);
        $this->post = $data->users_like_it;
    }
    public function render()
    {
        return view('livewire.reaction');
    }

    public function getLikeButtonClass () {

            if ($this->likeExist) {
                return "fas fa-heart like-color";
            } else {
                return "far fa-heart";
            }
    }

    public function getSaveButtonClass () {

        if ($this->saveExist) {
            return "fas fa-bookmark";
        } else {
            return "far fa-bookmark";
        }
}
    public function countLikes () {
      $post = Post::findOrFail($this->post_id);
      return $post->users_like_it->count();
    }
    public function clickLike () {

            if (!$this->likeExist) {
                DB::table('likes')->insert(
                    [
                        'user_id' => Auth::user()->id,
                        'post_id' => $this->post_id
                    ]
                    );
            $this->likeExist = true;

            } else {
                DB::table('likes')->select('id')->where( 'user_id',Auth::user()->id)
                ->where('post_id',$this->post_id)->delete();
                $this->likeExist = false;
            }
            $this->likesCount = $this->countLikes();
            $this->likebuttonClass = $this->getLikeButtonClass();


    }


    public function clickSave () {

        if (!$this->saveExist) {
            DB::table('saves')->insert(
                [
                    'user_id' => Auth::user()->id,
                    'post_id' => $this->post_id
                ]
                );
        $this->saveExist = true;

        } else {
            DB::table('saves')->select('id')->where( 'user_id',Auth::user()->id)
            ->where('post_id',$this->post_id)->delete();
            $this->saveExist = false;
        }

        $this->savebuttonClass = $this->getSaveButtonClass();
}
}
