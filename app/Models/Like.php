<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Like extends Model 
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
