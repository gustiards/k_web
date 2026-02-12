<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category',
        'description',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope untuk artikel terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get artikel terkait berdasarkan kategori
     */
    public function getRelatedArticles($limit = 3)
    {
        return self::where('category', $this->category)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get short description (100 karakter)
     */
    public function getShortDescriptionAttribute()
    {
        return \Illuminate\Support\Str::limit($this->description, 100);
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d F Y');
    }
}