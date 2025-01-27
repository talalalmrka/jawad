<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateSlug($name)
    {
        return Str::slug($name);
    }
}