<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

use Intervention\Image\ImageManagerStatic as Image;
class UploadImage extends Component
{
    use WithFileUploads;
    public $image;
    protected $listeners = ['imageUpload' => 'upload' ,
                            'deleteImage' => 'delete'];
    public function updated()
    {

        $this->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
    }

    public function delete () {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $user->update(
            [
                'avatar' => 'def.jpg'
            ]
        );
    }
    public function upload ($image) {

      $id = Auth::user()->id;
      $img = Image::make($image)->encode('jpg');
       $this->updatedPhoto();
      $name = 'avatars-'.$id . 'jpg' ;
      $img->save('images/users/' . $name);
      $user = User::findOrFail($id);
      $user->update(
          [
              'avatar' => $name
          ]
      );

    }
    public function render()
    {
        return view('livewire.upload-image');
    }
}
