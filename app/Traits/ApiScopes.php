<?php

namespace App\Traits;

trait ApiScopes
{
    public function scopePlatform($query, $value)
    {
        return $query->where('platform', $value);
    }
}