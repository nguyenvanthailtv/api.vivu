<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(mixed $orderByName, mixed $orderBy)
 * @method static findOrFail($id)
 * @method static create(array $all)
 * @method static whereIn(string $string, mixed $ids)
 */
class FAQs extends Model
{
    use HasFactory;

    protected $table = 'FAQs';

    protected $fillable = [
        'title',
        'description',
        'order',
        'status'
    ];
}
