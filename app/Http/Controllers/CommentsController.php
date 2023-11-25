<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;
use App\Models\post;

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
        comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);

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
