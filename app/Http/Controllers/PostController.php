<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $data = request()->validate([
            'caption' => ['required', 'string'],
            'image' => ['required', 'image']
        ]);
        $imgPath = request('image')->store('uploads', 'public');
        
        $img = Image::make(public_path("/storage/{$imgPath}"))->fit(1200, 1200);
        $img->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imgPath
        ]);

        return redirect()->route('profiles.show', [
            'user' => auth()->user()
        ]);
    }

    public function show(Post $post) {
       return view('posts.show', compact('post'));

    }
}
