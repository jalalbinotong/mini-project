<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notifController extends Controller
{
    public function notif()
    {
        $user_id = Auth::user()->id;
        $post = Post::all();
        $user = User::all();
        $follow = Follower::where('userFollow_id', $user_id)->get();
        $like = Like::where('userLike_id', $user_id)->get();
        $comment = Comment::where('userComment_id', $user_id)->get();

        return view('dashboard.users.pages.notifikasi', compact('follow', 'like', 'post', 'user', 'comment'));
    }
}
