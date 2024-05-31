<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // ini fungsi untuk user mengikuti user lain
    public function follower()
    {
        return $this->belongsTo(User::class, 'userFollow_id');
    }

    // ini fungsi untuk user yang diikuti
    public function followed()
    {
        return $this->belongsTo(User::class, 'id_follow');
    }
}
