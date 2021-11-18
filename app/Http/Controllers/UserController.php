<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index($username) {
        $data['user']= User::where('username' , $username)->firstOrFail();
        $data['posts'] = Post::where('user_id' , $data['user']->id)->latest()->get();
        return view('user.profile')->with($data);
    }

    public function edit()
    {
        $data['user']= User::findOrFail(Auth::user()->id);
        return view('user.edit')->with($data);
    }


    public function update(Request $request , $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username,' . Auth::user()->username.',username',
                'email' => 'required|email|unique:users,email,' . Auth::user()->email.',email',
                'bio' => 'max:60',
                'website' => '' ,
                'phone' => '',
                'gender' => ''
            ]
        );
        $id = Auth::user()->id;
        User::findOrFail($id)->update($data);

        return redirect(route('user.profile' , $id));

    }
    public function updateImg(Request $request)
    {

        $data = $request->validate(
            [
                'avatar' => 'required|image|mimes:jpg,jpeg,png',
            ]
        );
        // dd($request);
        $id = Auth::user()->id;
        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $name = 'avatars-'.$id . ".$extension";
        $user = User::findOrFail($id);

        $image->move('images/users/' , $name);
        $user->update(
            [
                'avatar' => $name
            ]
        );


        return redirect(route('user.profile' , $id));

    }

    public function deleteImg($id)
    {

        // dd($request);
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $user->update(
            [
                'avatar' => 'def.jpg'
            ]
        );


        return redirect(route('user.profile' , $id));
    }

    public function logout() {

        Auth::logout();
        return redirect('login');
    }
}
