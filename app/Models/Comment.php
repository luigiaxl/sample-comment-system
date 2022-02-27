<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
    ];

    /**
     * Get list of comment replies
     */
    public function replies()
    {
        return $this->hasMany($this::class);
    }
}
