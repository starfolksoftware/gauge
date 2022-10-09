<?php

namespace StarfolkSoftware\Gauge;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Reviewable
{
    /**
     * Leaves a review on the model.
     * 
     * @param mixed $user
     * @param int $rating
     * @param string|null $comment
     * 
     * @return void
     */
    public function review($user, int $rating, $comment = null)
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
        $review->user_id = $user->id;
        $review->rating = $rating;
        $review->comment = $comment;

        $review->save();
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
     * Returns the latest review.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function latestReview(): Attribute
    {
        return Attribute::make(fn () => $this->reviews()->latest()->first());
    }

    /**
     * Calculates the avarage rating
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function averageRating(): Attribute
    {
        return Attribute::make(fn () => $this->reviews()->avg('rating'));
    }

    /**
     * Calculates the total value of ratings
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function totalRating(): Attribute
    {
        return Attribute::make(fn () => $this->reviews()->sum('rating'));
    }

    /**
     * Returns the reviews count
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function reviewsCount()
    {
        return Attribute::make(fn () => $this->reviews()->count());
    }

    /**
     * Returns the count of the users that have rated.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function usersCount()
    {
        return Attribute::make(fn () => $this->reviews()->groupBy('user_id')->pluck('user_id')->count());
    }
}