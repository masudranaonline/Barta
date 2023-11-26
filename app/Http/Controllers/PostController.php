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
         $post = new post();

        $post->uuid = Uuid::uuid4();
        $post->post = $request->barta;
        $post->user_id = Auth::id();

        try {
            $post->save();

            foreach($request->images as $image) {
                $post->addMedia($image)->toMediaCollection('post_images');
            }
            return back();
        } catch (\Throwable $th) {
            throw $th;
        }

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
        // $post = DB::table('posts')
        // ->where('user_id', Auth::id())
        // ->where('uuid', $uuid)
        // ->first();

         $post = post::where('uuid', $uuid)->with('author')->first();

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
        // DB::table('posts')
        // ->where('uuid', $uuid)
        // ->where('user_id', Auth::id())
        // ->update([
        //     'post' => $request->barta
        // ]);

        $post =  post::where('uuid', $uuid)->update([
            'post' => $request->barta,
        ]);


        // $post->save();


    return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('posts')->where('uuid', $uuid)->delete();
        // // dd(post::destroy($uuid));

        post::destroy($id);
        return back();
    }
}
