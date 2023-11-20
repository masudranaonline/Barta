<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\post;

class UserController extends Controller
{

    public function posts(string $username){
        $user =  DB::table('users')->where('username', $username)->first();
        $posts = DB::table('posts')
            ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.user_id', '=',$user->id)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->get();
        return view('profile', compact('posts', 'user'));
    }

    //comments

    public function post(string $username, string $postId){
        // $user =  DB::table('users')->where('username', $username)->first();
        $post = DB::table('posts')
            ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.uuid', '=',$postId)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->first();
        $comments = DB::table('comments')
            ->select('comments.*',  'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            ->where('post_id', $post->id)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->get();
        return view('post', compact('post', 'comments'));
    }

    public function about(string $username){

    }

    public function photos(string $username){

    }


}
