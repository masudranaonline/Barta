<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Notifications\UserLikesNotification;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $posts = post::with(['author.media', 'media', 'likes'])->paginate(1);
        $posts = post::with(['author.media', 'media', 'likes'])->latest()->paginate(5);
        
         $notifications = Notification::where('notifiable_id', Auth::user()->id)->get();
         $noti= [];
         foreach ($notifications as $notification) {
            $decodeData = json_decode($notification->data);
            // return $decodeData;
            $user = User::where('id', $decodeData->user_id)->first();
            $data = [
                'notifications' => $notification,
                'author' => $user,
                'mess' => $decodeData,
            ];
            // return $data;
            array_push($noti, $data);
            
         }
        //  return $noti;
        session()->put('notifications', $noti);
        
        if ($request->ajax()) {
            return response()->json($posts);
        }

        return view('home', compact('posts'));
    }

    public function notify() {
        // if(auth()->user()) {
        //     $user = Auth::user();

        //     auth()->user()->notify(new UserLikesNotification($user));
        // }
    }
    /**
     * Show the form for creating a new resource.
     */

    public function search(string $searchText = null)
    {

        if (!is_null($searchText)) {
            //post content search
            $posts = post::Where('post', 'like', '%' . $searchText . '%')
                ->with(['author.media', 'media', 'comments.author'])->get();
            //user profile search
            $users = User::Where('name', 'like', '%' . $searchText . '%')
                ->orWhere('email', 'like', '%' . $searchText . '%')
                ->with('media')->get();
        } else {
            $posts = [];
            $users = [];
        }

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
    public function show()
    {
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
