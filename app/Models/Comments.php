<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'body',
        'commentable_type',
        'commentable_id',
        'created_at',
        'updated_at'
    ];

    public function commentable():MorphTo
    {
        return $this->morphTo();
    }
}
