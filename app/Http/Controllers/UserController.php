<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\comment;

class UserController extends Controller
{

    public function posts(string $username)
    {
         $user = User::with('media')->where('username', $username)->first();
        //  return $posts = post::with('author.media', 'media')->where('user_id', $user->id)->get();
         $posts = post::with('author.media', 'media')->where('user_id', $user->id)->latest()->get();


        return view('profile', compact('posts', 'user'));


    }

    //comments

    public function post(string $username, string $postId)
    {
          $post = post::with(['author.media', 'media', 'comments.author.media'])->where('uuid', $postId)->first();
         return view('post', compact('post'));
    }

    public function about(string $username){

    }

    public function photos(string $username){

    }

    public function store(Request $request, string $username) {
        if($request->hasFile('avatar')){
            $user = User::where('username', $username)->first();
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('avatar')->toMediaCollection('profile_image');
        }
        return back();
    }


    public function show(Request $request) {

    }


}
