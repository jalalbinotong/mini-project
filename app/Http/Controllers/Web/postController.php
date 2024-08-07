<?php

namespace App\Http\Controllers\Web;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Like_comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class postController extends Controller
{
    public function detailPost($id)
    {
        $post = Post::with(['user', 'comments.user', 'comments.replies.user'])->findOrFail($id);
        $user = User::find($id);
        return view('dashboard.users.pages.detailPost', compact('post', 'user'));
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:2000',
        ]);

        $comment = new Comment;
        $comment->userComment_id = Auth::id();
        $comment->postComment_id = $postId;
        $comment->comment = $request->comment;
        $comment->save();

        return back()->with('success', 'Created comment has been Success');
    }

    public function storeReply(Request $request, $commentId)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:2000',
        ]);

        $comment = Comment::findOrFail($commentId);

        $reply = new Reply;
        $reply->userReply_id = Auth::id();
        $reply->postReply_id = $comment->postComment_id;
        $reply->commentReply_id = $commentId;
        $reply->comment = $request->comment;
        $reply->save();

        return back()->with('success', 'Created reply has been Success');;
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() != $comment->userComment_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['success' => 'Comment deleted successfully']);
    }

    public function deleteReply($id)
    {
        $reply = Reply::findOrFail($id);

        if (auth()->id() != $reply->userReply_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $reply->delete();

        return response()->json(['success' => 'Reply deleted successfully']);
    }

    public function createPost()
    {
        return view('dashboard.users.pages.createPost');
    }

    public function doneCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required|min:3|max:2000',
            'gambar' => 'nullable|image|file|mimes:jpeg,png,jpg|max:2000'
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('create_post')
                ->withErrors($validator)
                ->withInput();
        }
    
        $fileName = null;
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images'), $fileName);
        }
            
        $post = Post::create([
            'user_id' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'gambar' => $fileName ? '/storage/images/' . $fileName : null,
        ]);
    
        // echo($post);
        return redirect('/')->with([
            'tipe_pesan' => 'berhasil',
            'pesan' => 'Produk Telah Berhasil Ditambahkan!'
        ]);
    }

    public function likePost(Request $request)
    {
        $post_id = $request->postLike_id;
        $user_id = auth()->id();

        $like = Like::where('postLike_id', $post_id)->where('userLike_id', $user_id)->first();

        if ($like) {
            // If already liked, unlike it
            $like->delete();
            $liked = false;
        } else {
            // If not liked, like it
            Like::create([
                'userLike_id' => $user_id,
                'postLike_id' => $post_id,
            ]);
            $liked = true;
        }

        return response()->json(['liked' => $liked]);
    }

    public function likeComment(Request $request)
    {
        $comment_id = $request->commentLike_id;
        $user_id = auth()->id();

        $like = Like_comment::where('commentLike_id', $comment_id)->where('userLikeComm_id', $user_id)->first();

        if ($like) {
            // If already liked, unlike it
            $like->delete();
            $liked = false;
        } else {
            // If not liked, like it
            Like_comment::create([
                'userLikeComm_id' => $user_id,
                'commentLike_id' => $comment_id,
            ]);
            $liked = true;
        }

        return response()->json(['liked' => $liked]);
    }
    

    public function bookmark()
    {
        $id = Auth::user()->id;
        $user = User::all();
        // $bookmark = Post::whereHas('favorites', function($query) use ($user) {
        //     $query->where('userFav_id', $user);
        // })->with('user')->get();
        $post = Post::all();
        $bookmark = Favorite::where('userFav_id', $id)->get();
        // echo($bookmark);
        return view('dashboard.users.pages.bookmark', compact('user','bookmark', 'post'));
    }

    public function bookmarkPost(Request $request)
    {
        $post_id = $request->input('postFav_id');  // Ambil post_id dari request
        $user_id = auth()->id();

        $favorite = Favorite::where('postFav_id', $post_id)->where('userFav_id', $user_id)->first();

        if ($favorite) {
            // If already bookmarked, remove bookmark
            $favorite->delete();
            $bookmarked = false;
        } else {
            // If not bookmarked, add bookmark
            Favorite::create([
                'userFav_id' => $user_id,
                'postFav_id' => $post_id,
            ]);
            $bookmarked = true;
        }

        return response()->json(['bookmarked' => $bookmarked]);
    }
}
