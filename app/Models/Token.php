<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Token extends Model
{
    protected $fillable = ['access_token'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
