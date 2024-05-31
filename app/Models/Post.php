<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'postFav_id');
    }

    public function isBookmarkedByUser()
    {
        return $this->favorites()->where('userFav_id', auth()->id())->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postComment_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'postLike_id');
    }

    public function isLikedByUser()
    {
        return $this->likes()->where('userLike_id', auth()->id())->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
