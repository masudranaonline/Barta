<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\comment;

class UserController extends Controller
{

    public function posts(string $username){
        // $user =  DB::table('users')->where('username', $username)->first();
        // $posts = DB::table('posts')
        //     ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
        //     ->orderBy('posts.created_at', 'desc')
        //     ->where('posts.user_id', '=',$user->id)
        //     ->join('users', 'posts.user_id', '=', 'users.id')
        //     ->get();

            // $user = User::where('username', $username)->first();
            // $posts = post::where('posts.user_id', '=',$user->id)
            // ->join('users', 'posts.user_id', '=', 'users.id')
            // ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            // ->orderBy('posts.created_at', 'desc')
            // ->get();

            $user = User::where('username', $username)->first();

            $posts = post::with('author')->where('user_id', $user->id)->get();


        return view('profile', compact('posts', 'user'));
    }

    //comments

    public function post(string $username, string $postId){
        // $user =  DB::table('users')->where('username', $username)->first();
        // $post = DB::table('posts')
        //     ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
        //     ->orderBy('posts.created_at', 'desc')
        //     ->where('posts.uuid', '=',$postId)
        //     ->join('users', 'posts.user_id', '=', 'users.id')
        //     ->first();
        // $comments = DB::table('comments')
        //     ->select('comments.*',  'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
        //     ->where('post_id', $post->id)
        //     ->join('users', 'comments.user_id', '=', 'users.id')
        //     ->get();

            // $post = post::where('posts.uuid', '=', $postId)
            //     ->join('users', 'posts.user_id', '=', 'users.id')
            //     ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            //     ->orderBy('posts.created_at', 'desc')
            //     ->first();
            // $comments = comment::join('users', 'comments.user_id', '=', 'users.id')
            //     ->select('comments.*',  'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            //     ->where('post_id', $post->id)
            //     ->get();

             $post = post::with(['author', 'comments.author'])->where('uuid', $postId)->first();

            //  $comments = post::with('comment.author')->where('uuid', $postId)->get();


        return view('post', compact('post'));
    }

    public function about(string $username){

    }

    public function photos(string $username){

    }


}
