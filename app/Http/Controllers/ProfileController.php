<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user) {
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user) {
        if($user == auth()->user()) {
            return view('profiles.edit', compact('user'));
        } else {
            return redirect()->route('profiles.show', ['user' => $user]);
        }
        
    }

    public function update(User $user) {
        if($user == auth()->user()) {
            $data = request()->validate([
                'title' => 'required',
                'description' => 'required',
                'url' => 'required|url'
            ]);
    
            auth()->user()->profile->update($data);
    
            return redirect()->route('profiles.show', [
                'user' => $user
            ]);
        } else {
            return redirect()->route('profiles.show', ['user' => $user]);
        }
    }

    public function authHandler(User $user, Profile $profile) {
        if($user->username == $profile->user->username) {
            redirect()->route('profiles.edit', ['user' => $user]);
        } else {
            redirect()->route('profiles.show', ['user' => $user]);
        }
    }
}
