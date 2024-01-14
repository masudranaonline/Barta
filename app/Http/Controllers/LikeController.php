<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserLikesNotification;
use Exception;


class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $like = Like::where('post_id', $postId)->where('user_id', Auth::id())->first();

        if($like) {
            DB::beginTransaction();

            try {
                $like->forceDelete();

                $post = post::find($postId);
                $post->likes_count -=1;
                $post->save();
                

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }else {
            DB::beginTransaction();
            try {
                $likeStore = Like::create([
                    'post_id' => $postId,
                    'user_id' => Auth::id(),
                ]);

                // return User::all();
                $user = User::where('email', $request->author_email)->first();
                $user->notify(new \App\Notifications\UserLikesNotification($likeStore));
                

                $post = post::find($postId);
                $post->likes_count +=1;
                $post->save();


                DB::commit();
            } catch (\Throwable $th) {
                throw $th;
                DB::rollBack();
            }
        }

         

            // $user = User::where('email', $request->author_email)->first();
            // $user->notify(new \App\Notifications\CommentInPost($comment));
    

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
