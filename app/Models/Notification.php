<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'title',
        'sent_at',
        'message',
        'url',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
