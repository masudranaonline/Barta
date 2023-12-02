<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'uuid',
        'post',
        'user_id',
        'view_count',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments() {
        return $this->hasMany(comment::class);
    }

    public function likes() {
        return $this->hasMany(like::class);
    }
}
