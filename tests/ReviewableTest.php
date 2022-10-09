<?php

use StarfolkSoftware\Gauge\Gauge;
use StarfolkSoftware\Gauge\Tests\Mocks\Item;
use StarfolkSoftware\Gauge\Tests\Mocks\Review;

test('reviews can be added to a reviewable model', function () {
    Gauge::useReviewModel(Review::class);

    $item = Item::forceCreate(['name' => 'Item 1']);

    $review = new Review();

    $review->user_id = 1;
    $review->rating = 4;
    $review->comment = 'hello';

    $item->reviews()->save($review);

    expect($item->fresh()->reviews()->count())->toBe(1);
});
