<?php

namespace App\Http\Controllers\Web;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function home()
    {
        // untuk mengecek apakah user sedang login atau tidak
        $user_id = Auth::check() ? Auth::user()->id : null;
        $posts = Post::with(['user', 'comments.replies'])->orderBy('created_at', 'desc')->get();

        foreach ($posts as $post) {
            $totalComments = $post->comments->count();
            foreach ($post->comments as $comment) {
                $totalComments += $comment->replies->count();
            }
            $post->totalComments = $totalComments;
        }

        $user = User::all();

        if ($user_id) {
            // Mendapatkan daftar pengguna yang diikuti oleh user yang sedang login
            $following = Follower::where('userFollow_id', $user_id)->pluck('id_follow');

            // Mendapatkan daftar rekomendasi pengguna yang belum diikuti dan bukan user yang sedang login
            $recommendations = User::where('id', '!=', $user_id)
                                    ->whereNotIn('id', $following)
                                    ->take(5)
                                    ->get();
        } else {
            // Jika pengguna tidak login, rekomendasi kosong atau bisa disesuaikan sesuai kebutuhan
            $recommendations = User::take(5)->get();
        }

        return view('dashboard.home', ['post' => $posts, 'user' => $user, 'follow' => $recommendations]);
    }

}
