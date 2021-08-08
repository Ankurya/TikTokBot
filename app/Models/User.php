<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
