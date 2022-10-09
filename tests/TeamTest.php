<?php

use StarfolkSoftware\Gauge\Gauge;
use StarfolkSoftware\Gauge\Tests\Mocks\Review;
use StarfolkSoftware\Gauge\Tests\Mocks\Team;

test('teams can have reviews', function () {
    Gauge::useReviewModel(Review::class);

    $team = Team::forceCreate(['name' => 'Item 1']);

    $review = new Review(Review::factory()->raw());

    $team->reviews()->save($review);

    expect($team->fresh()->reviews()->count())->toBe(1);
});