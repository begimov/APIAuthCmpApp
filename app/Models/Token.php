<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Token extends Model
{
    protected $fillable = ['access_token', 'refresh_token', 'expires_in'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasExpired()
    {
        return now()->gte($this->updated_at->addSeconds($this->expires_in));
    }
}
