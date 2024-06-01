<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class searchingController extends Controller
{
    public function searching(Request $request)
    {
        $user_id = Auth::check() ? Auth::user()->id : null;

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
        
        // fitur search
        $query = User::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            # code...
            $search = $request->get('search');
            $query->where('username', 'like', '%' . request()->get('search') . '%');
        }

        $users = $query->get(); 
    
        return view('dashboard.users.pages.searching', compact('recommendations', 'users'));
    }
}
