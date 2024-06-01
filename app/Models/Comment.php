<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function replies()
    {
        return $this->hasMany(Reply::class, 'commentReply_id');
    }

    public function like_comments()
    {
        return $this->hasMany(Like_comment::class, 'commentLike_id');
    }

    public function isLikedCommentByUser()
    {
        return $this->like_comments()->where('userLikeComm_id', auth()->id())->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userComment_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postComment_id');
    }
}
