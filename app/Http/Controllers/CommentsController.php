<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;
use App\Models\post;
use App\Models\User;
use App\Notifications\CommentInPost;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $uuid)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $comment = comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);

        $user = User::where('email', $request->author_email)->first();
        $user->notify(new \App\Notifications\CommentInPost($comment));

        // if(auth()->user()) {
        //     $user = Auth::user();
        //     $user->notify(new CommentInPost($user));

        //     // auth()->user()->notify(new UserLikesNotification($user));
        // }

        $post = post::find($postId);
        $post->comments_count += 1;
        $post->save();


        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
