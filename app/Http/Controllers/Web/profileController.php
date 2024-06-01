<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class profileController extends Controller
{
    public function profile()
    {
        $user = Auth::user()->id;
        $post = Post::where('user_id', $user)->get();
        $following = Follower::where('userFollow_id', $user)->get();
        $followers = Follower::where('id_follow', $user)->get();
        // echo($post);
        return view('dashboard.users.pages.profile', compact('post','followers','following'));
    }

    public function seeFollowings(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $followings = Follower::where('userFollow_id', $user->id)->pluck('id_follow');

        $query = User::whereIn('id', $followings);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('username', 'like', '%' . $search . '%');
        }

        $following = $query->get();

        return view('dashboard.users.pages.followings', compact('user', 'following'));
    }

    public function seeFollower(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $follower = Follower::where('id_follow', $user->id)->pluck('userFollow_id');

        $query = User::whereIn('id', $follower);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('username', 'like', '%' . $search . '%');
        }

        $followers = $query->get();

        return view('dashboard.users.pages.followers', compact('user', 'followers'));
    }
    
    public function editProfile()
    {
        $user = Auth::user()->id;
        $users = User::where('id', $user)->first();
        return view('dashboard.users.pages.editProfile', compact('users'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'bio' => 'required|min:3|max:2000',
            'foto' => 'nullable|image|file|mimes:jpeg,png,jpg|max:2000'
        ]);
        // dd($validator->errors());
        if ($validator->fails()) {
            return redirect()->route('edit_profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(Auth::id()); // Menggunakan Auth::id() untuk mendapatkan ID pengguna yang saat ini diautentikasi

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/images', $fileName);

            $user->foto = '/storage/images/' . $fileName;
        }

        $user->username = $request->username;
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->save();

        // echo($user);

        return redirect()->route('profile')->with([
            'tipe_pesan' => 'berhasil',
            'pesan' => 'Produk Telah Berhasil Diedit!'
        ]);
    }

}
