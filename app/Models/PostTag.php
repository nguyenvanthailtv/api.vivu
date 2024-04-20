<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTag extends Model
{
    use HasFactory;

    protected $table = 'post_tags';
    protected $fillable = [
        'post_id',
        'tag_id'
    ];

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function tag(): BelongsTo {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
