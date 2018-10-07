<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id'];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function scopeByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
