<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
    ];


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    } 
    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
