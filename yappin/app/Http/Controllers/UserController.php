<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use Auth;


class UserController extends Controller
{
    public function profile($name){
        $user = User::where('name', '=', $name)->firstorfail();

        return view('users.profile', compact('user'));
    }

    public function edit($name){
        $user = User::where('name', '=', $name)->firstorfail();

        return view('users.edit', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();


        $request->validate([
            'name' => ['required', 'string', 'max:15', 'min:4', 'unique:users,name,' . auth()->id()],
            'biography' => ['string', 'nullable'],
            'birthday' => ['date', 'nullable'],
        ]);        

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar = str_replace('public/', '', $avatarPath);
        }

        $user->name = $request->name;
        $user->biography = $request->biography;
        $user->birthday = $request->birthday;

        $user->save();

        return redirect()->route('profile', ['name' => $user->name])->with('status', 'Profile edited');
}

}
