<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment as ModelsComment;
use Illuminate\Support\Facades\Auth;

class CommentBar extends Component
{
    public $post_id ;
    public $comment;

    public function mount ($id) {
        $this->post_id = $id;

    }
    public function rules()
    {
        return [
            'comment'=> 'string|required|max:50'
        ];
    }
    public function render()
    {
        return view('livewire.comment-bar');
    }
    public function save () {
        $this->validate();

        $user_id = Auth::user()->id;
        ModelsComment::create(
            [
                'user_id' => $user_id,
                'post_id' => $this->post_id,
                'comment' => $this->comment
            ]
        );

        session()->flash('message', 'Comment successfully added.');
        $this->comment='';
        $this->emit('alert_remove');
    }
}
