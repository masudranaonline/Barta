<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function store(Request $request)
    {
        DB::table('posts')->insert([
            'uuid' => Uuid::uuid4(),
            'post' => $request->barta,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

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
    public function edit(string $uuid)
    {
        $post = DB::table('posts')
        ->where('user_id', Auth::id())
        ->where('uuid', $uuid)
        ->first();

        if(!$post){
            return "The Post you are searchhing is not available";
        }


        return view('post_edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        DB::table('posts')
        ->where('uuid', $uuid)
        ->where('user_id', Auth::id())
        ->update([
            'post' => $request->barta
        ]);

    return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        DB::table('posts')->where('uuid', $uuid)->delete();
        // dd(post::destroy($uuid));
        return back();
    }
}
