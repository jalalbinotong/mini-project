<?php

namespace App\Http\Controllers\Web;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    public function home()
    {
        $posts = Post::with(['user', 'comments.replies'])->orderBy('created_at', 'desc')->get();
        foreach ($posts as $post) {
            $totalComments = $post->comments->count();
            foreach ($post->comments as $comment) {
                $totalComments += $comment->replies->count();
            }
            $post->totalComments = $totalComments;
        }
        $user = User::all();

        return view('dashboard.home', ['post' => $posts, 'user' =>$user]);
    }
}
