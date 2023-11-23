<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

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
}
