<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'subtitle', 'description', 
        'content', 'image', 'tags', 'is_published', 'urutan'
    ];

    // Simple slug generator if not using Spatie/Sluggable or just manual
    // Let's use Str::slug in logic or observer, or basic mutator.
    // For now, let's just make it fillable.
}
