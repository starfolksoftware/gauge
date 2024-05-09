<?php

namespace StarfolkSoftware\Gauge;

trait Reviewable
{
    /**
     * Leaves a review on the model.
     *
     * @param  mixed  $user
     * @param  string|null  $comment
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
}
