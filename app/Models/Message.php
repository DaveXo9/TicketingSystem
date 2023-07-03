<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [ 'message', 'user_id', 'recepient_id'];

    // Search users that you want exchange messages with
    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false ){
            $query->whereHas('user', function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recepient(){
        return $this->belongsTo(User::class, 'recepient_id');
    }
}
