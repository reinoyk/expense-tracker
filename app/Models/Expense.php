<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'amount',
        'date',
        'user_id',
        'category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * This ensures the 'date' is always a Carbon instance and 'amount' is a float.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the Expense belongs to
     *
     * Defines an inverse one-to-many relationship.
     * An expense belongs to a single category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
