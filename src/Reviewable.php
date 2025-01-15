<?php

namespace StarfolkSoftware\Gauge;

trait Reviewable
{
    /**
     * Leaves a review on the model.
     */
    public function review(string|object $user, int $rating, $comment = null)
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
}
