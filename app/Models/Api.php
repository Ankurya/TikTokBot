<?php

namespace App\Models;

use App\Traits\ApiScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Api extends Model
{
    use HasFactory;
    use ApiScopes;

    protected $fillable = [
        'platform', 'api_key', 'properties'
    ];
}
