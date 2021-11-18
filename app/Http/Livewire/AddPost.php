<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\WithFileUploads;
class AddPost extends Component
{
    public $avatar;
    public $caption;
    public $tags;
    public $regex = '/#(\w+)$/ig';
    public $photoStatus;
    protected $listeners = ['deleteTmpUrl' => 'deleteTmp' ,
                            'getHash' => 'getHash' ,
                            'unsetTag' => 'unsetTag'];
    use WithFileUploads;

    public function rules()
    {
        return [
            'caption' => 'string|nullable|max:100',
            'avatar' => 'required|image|mimes:png,jpg,jpeg'
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }
    public function getHash ($hash) {
            $hash = str_replace('#', '', $hash);
            $tag = Tag::where('hashtag' , 'like' ,$hash.'%')->limit(5)->get();
            $this->tags = $tag;
    }
    public function unsetTag () {
            $this->tags = null;
    }
    public function save()
    {
        $this->validate();
        preg_match_all("/#+([a-zA-Z0-9_]+)/i", $this->caption, $hashtag);
        $user = Auth::user();
        $ext = $this->avatar->getClientOriginalExtension();
        $name = 'post-'.$user->username .'-'.uniqid() . ".$ext";
        $img = Image::make($this->avatar);
        $img->save('images/posts/' . $name);

       $post = Post::create(
            [
                'image' => $name,
                'caption' => $this->caption,
                'user_id' => $user->id
            ]
        );
        // Store Hashtag
        foreach($hashtag[1] as $hash) {
            if (!Tag::select('hashtag')->where('hashtag' , $hash)->exists()) {
                $tag =Tag::create(
                    ['hashtag' => $hash]
                );
            } else {
                $tag = Tag::where('hashtag' , $hash)->first();
            }

            DB::table('post_tag')->insert(
                [
                    'tag_id' => $tag->id,
                    'post_id' => $post->id
                ]
            );
        }
        session()->flash('message', 'Post successfully added.');
        $this->avatar = '';
        $this->caption ='';
        $this->emit('alert_remove');
    }
    public function deleteTmp () {
       $this->avatar = '' ;
    }
    public function render()
    {
        return view('livewire.add-post');
    }
}
