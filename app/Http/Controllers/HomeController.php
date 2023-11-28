<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return  $user = User::with(['media'])->find(Auth::user());


         $posts = post::with(['author.media', 'media'])->latest()->get();
        return view('home', compact('posts', 'user'));
    }
    /**
     * Show the form for creating a new resource.
     */

    public function search(string $searchText = null) {
        //post content search
        $posts = post::Where('post', 'like', '%'.$searchText.'%')
                    ->with(['author', 'media', 'comments.author'])->get();
        //user profile search
        $users = User::Where('name', 'like', '%'.$searchText.'%')
                    ->orWhere('email', 'like', '%'.$searchText.'%')->get();

        return view('search-result', compact('posts', 'users'));
    }


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
