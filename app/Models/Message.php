<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [ 'message', 'user_id', 'recepient_id'];

    // Search users that you want exchange messages with
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('created_at', '>=', function ($query) use ($filters) {
                $query->select('created_at')
                    ->from('messages')
                    ->where('message', 'like', '%' . request('search') . '%')
                    ->orderBy('created_at')
                    ->limit(1);
            });
        }        
        
        // Add any additional query conditions or logic here
        
        return $query;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recepient(){
        return $this->belongsTo(User::class, 'recepient_id');
    }
}
