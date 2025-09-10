<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'category_id', 'title', 'author_id', 'content'];

    // membuat eager loading agar menghemat query dan mempercepat performance
    protected $with = ['author', 'category'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {

        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            })
        );

        // untuk relasi ke category
        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) => 
            $query->whereHas('category', fn($query) => 
            $query->where('slug', $category))
        );

        // untuk relasi ke author
        $query->when(
            $filters['author'] ?? false,
            fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
            $query->where('name', $author))
        );
    }
}
