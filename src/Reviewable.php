<?php

namespace StarfolkSoftware\Gauge;

use Illuminate\Database\Eloquent\Model;

trait Reviewable
{
    /**
     * Leaves a review on the model.
     */
    public function review(string|object $user, int $rating, $comment = null, bool $approved = true): Model
    {
        $review = Gauge::newReviewModel();

        if (Gauge::$supportsSingleReviews) {
            $review = Gauge::newReviewModel()->query()
                ->whereReviewableType($this->getMorphClass())
                ->whereReviewableId($this->id)
                ->whereUserId($user->id)
                ->first() ?? $review;
        }

        $review->reviewable_type = $this->getMorphClass();
        $review->reviewable_id = $this->id;

        if (is_object($user)) {
            $review->user_id = $user->id;
        } elseif (is_string($user)) {
            $review->reviewer_name = $user;
        }

        if ($approved) {
            $review->approved_at = now();
        }

        $review->rating = $rating;
        $review->comment = $comment;

        $review->save();

        return $review->fresh();
    }

    /**
     * Retrieves the reviews of the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function reviews()
    {
        return $this->morphMany(Gauge::$reviewModel, 'reviewable');
    }

    /**
     * Get the average rating for the model.
     */
    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 2);
    }

    /**
     * Get the total number of reviews for the model.
     */
    public function reviewCount(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Check if the model has been reviewed by a specific user.
     */
    public function hasReviewByUser(Model $user): bool
    {
        return $this->reviews()->where('user_id', $user->id)->exists();
    }

    /**
     * Get all reviews for the model by a specific user.
     */
    public function reviewsByUser(Model $user)
    {
        return $this->reviews()->where('user_id', $user->id)->get();
    }

    /**
     * Delete all reviews for the model.
     */
    public function deleteAllReviews(): bool
    {
        return $this->reviews()->delete();
    }

    /**
     * Get reviews with a specific rating.
     */
    public function reviewsWithRating(int $rating)
    {
        return $this->reviews()->where('rating', $rating)->get();
    }

    /**
     * Get the highest rating given to the model.
     */
    public function highestRating(): int
    {
        return $this->reviews()->max('rating') ?? 0;
    }

    /**
     * Get the lowest rating given to the model.
     */
    public function lowestRating(): int
    {
        return $this->reviews()->min('rating') ?? 0;
    }

    /**
     * Get the latest review for the model.
     */
    public function latestReview()
    {
        return $this->reviews()->latest()->first();
    }

    /**
     * Get the oldest review for the model.
     */
    public function oldestReview()
    {
        return $this->reviews()->oldest()->first();
    }

    /**
     * Calculate the distribution of ratings.
     */
    public function ratingDistribution(): array
    {
        $distribution = $this->reviews()
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        return $distribution + array_fill(1, 5, 0); // Ensures all ratings (1-5) are represented.
    }

    /**
     * Get all approved reviews for the model.
     */
    public function approvedReviews()
    {
        return $this->reviews()->whereNotNull('approved_at');
    }

    /**
     * Get the total number of approved reviews.
     */
    public function approvedReviewCount(): int
    {
        return $this->approvedReviews()->count();
    }

    /**
     * Get the average rating for approved reviews.
     */
    public function averageApprovedRating(): float
    {
        return round($this->approvedReviews()->avg('rating') ?? 0, 2);
    }

    /**
     * Approve a specific review by ID.
     */
    public function approveReview(int $reviewId): bool
    {
        $review = $this->reviews()->find($reviewId);

        if ($review && is_null($review->approved_at)) {
            $review->approved_at = now();

            return $review->save();
        }

        return false;
    }

    /**
     * Approve all reviews for the model.
     */
    public function approveAllReviews(): bool
    {
        return $this->reviews()
            ->whereNull('approved_at')
            ->update(['approved_at' => now()]);
    }

    /**
     * Get reviews awaiting approval.
     */
    public function pendingReviews()
    {
        return $this->reviews()->whereNull('approved_at');
    }

    /**
     * Get the total number of pending reviews.
     */
    public function pendingReviewCount(): int
    {
        return $this->pendingReviews()->count();
    }

    /**
     * Check if the model has approved reviews.
     */
    public function hasApprovedReviews(): bool
    {
        return $this->approvedReviews()->exists();
    }

    /**
     * Check if the model has pending reviews.
     */
    public function hasPendingReviews(): bool
    {
        return $this->pendingReviews()->exists();
    }

    /**
     * Mark a review as unapproved.
     */
    public function unapproveReview(int $reviewId): bool
    {
        $review = $this->reviews()->find($reviewId);

        if ($review && $review->approved_at) {
            $review->approved_at = null;

            return $review->save();
        }

        return false;
    }
}
