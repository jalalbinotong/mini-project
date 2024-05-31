<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class followController extends Controller
{
    public function following()
    {
        $user_id = Auth::user()->id;

        // Mendapatkan daftar pengguna yang diikuti oleh user yang sedang login
        $following_ids = Follower::where('userFollow_id', $user_id)->pluck('id_follow');

        // Mendapatkan postingan dari pengguna yang diikuti
        $posts = Post::whereIn('user_id', $following_ids)
                    ->with(['user', 'comments.replies', 'likes'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        foreach ($posts as $p) {
            $totalComments = $p->comments->count();
            foreach ($p->comments as $comment) {
                $totalComments += $comment->replies->count();
            }
            $p->totalComments = $totalComments;
        }

        // Mendapatkan daftar rekomendasi pengguna yang belum diikuti dan bukan user yang sedang login
        $recommendations = User::where('id', '!=', $user_id)
                                ->whereNotIn('id', $following_ids)
                                ->take(5)
                                ->get();

        return view('dashboard.following', compact('recommendations', 'posts'));
    }


    public function followUser(Request $request)
    {
        $user_id = Auth::id();
        $follow_id = $request->input('id_follow');

        $isFollowing = Follower::where('userFollow_id', $user_id)->where('id_follow', $follow_id)->exists();

        if ($isFollowing) {
            Follower::where('userFollow_id', $user_id)
                    ->where('id_follow', $follow_id)
                    ->delete();
        } else {
            Follower::create([
                'userFollow_id' => $user_id,
                'id_follow' => $follow_id
            ]);
        }

        return response()->json(['isFollowing' => !$isFollowing]);
    }
}
