<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user) {
        $isFollowing = (auth()->user()) 
            ? auth()->user()->following->contains($user->profile->id) 
            : false
        ;

        return view('profiles.show', compact('user', 'isFollowing'));
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        $this->authorize('update', $user->profile);    
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required|url',
            'image' => 'sometimes|image|max:3000'
        ]);

        // If update avatar
        if(request('image')) {
            $imgPath = request('image')->store('avatars', 'public');
            $img = Image::make(public_path("/storage/{$imgPath}"))->fit(800, 800);
            $img->save();

            auth()->user()->profile->update(array_merge(
                $data,
                ['image' => $imgPath]
            ));
        } else {
            auth()->user()->profile->update($data);
        }

        return redirect()->route('profiles.show', [
            'user' => $user
        ]);
    }
}
