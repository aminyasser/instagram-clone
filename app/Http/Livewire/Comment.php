<?php

namespace App\Http\Livewire;

use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Comment as ModelsComment;
class Comment extends Component
{
     public $comments;
     public $post_id ;
     public $post;
     public $comment;

    public function mount ($id) {
        $this->post_id = $id;
        $this->post = Post::findOrFail($id);
        $this->comments = $this->post->comments ;
    }
    public function render()
    {
        return view('livewire.comment');
    }

    public function rules()
    {
        return [
            'comment'=> 'string|required|max:50'
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save () {
        $this->validate();

        $user_id = Auth::user()->id;

        $new= ModelsComment::create(
            [
                'user_id' => $user_id,
                'post_id' => $this->post_id,
                'comment' => $this->comment
            ]
        );
        $this->post = Post::findOrFail($this->post_id);
        $this->comments->push($new);
        $this->comment = '';

        session()->flash('message', 'Comment successfully added.');

    }


}
