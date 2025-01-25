<?php

namespace StarfolkSoftware\Gauge;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'user_id',
        'reviewer_name',
        'reviewable_type',
        'reviewable_id',
        'rating',
        'comment',
        'approved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /**
     * Returns the table name.
     */
    public function getTable(): string
    {
        return Gauge::$reviewsTableName;
    }

    /**
     * Get the team that owns the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Gauge::$teamModel, 'team_id');
    }

    /**
     * Returns the reviewable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * Returns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Gauge::userModel());
    }

    /**
     * Scope to get only approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->whereNotNull('approved_at');
    }

    /**
     * Scope to get only pending reviews.
     */
    public function scopePending($query)
    {
        return $query->whereNull('approved_at');
    }

    /**
     * Approve the review.
     */
    public function approve(): bool
    {
        $this->approved_at = now();
        return $this->save();
    }

    /**
     * Unapprove the review.
     */
    public function unapprove(): bool
    {
        $this->approved_at = null;
        return $this->save();
    }

    /**
     * Checks if the review is approved.
     */
    public function isApproved(): bool
    {
        return !is_null($this->approved_at);
    }

    /**
     * Checks if the review is pending approval.
     */
    public function isPending(): bool
    {
        return is_null($this->approved_at);
    }

    /**
     * Returns the formatted date the review was approved.
     */
    public function approvedDate(): ?string
    {
        return $this->approved_at?->format('M d, Y');
    }

    /**
     * Returns the rating as a percentage (0-100).
     */
    public function ratingPercentage(int $maxRating = 5): float
    {
        return ($this->rating / $maxRating) * 100;
    }

    /**
     * Format the review comment for display (e.g., truncating).
     */
    public function truncatedComment(int $length = 50): string
    {
        return str($this->comment)->limit($length);
    }

    /**
     * Get the reviewer name or fallback to "Anonymous".
     */
    public function reviewerDisplayName(): string
    {
        return $this->reviewer_name ?: ($this->user?->name ?? 'Anonymous');
    }

    /**
     * Get the related model's type in a human-readable format.
     */
    public function reviewableTypeLabel(): string
    {
        return class_basename($this->reviewable_type);
    }
}
