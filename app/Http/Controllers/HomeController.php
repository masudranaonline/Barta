<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DB::table('posts')
            ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->get();
        return view('home', compact('posts'));
    }

    public function timeline(string $username){
         $user =  DB::table('users')->where('username', $username)->first();
        $posts = DB::table('posts')
            ->select('posts.*', 'users.name as author_name', 'users.email as author_email', 'users.username as author_username')
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.user_id', '=',$user->id)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->get();
        return view('post', compact('posts'));
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
        //
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
