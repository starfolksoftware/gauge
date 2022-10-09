<?php

use StarfolkSoftware\Gauge\Gauge;
use StarfolkSoftware\Gauge\Tests\Mocks\Review;

test('review can be saved to database', function () {
    Review::factory()->create();

    expect(Review::count())->toBe(1);
});

test('review can be soft deleted', function () {
    Gauge::supportsSoftDeletes();

    $review = Review::factory()->create();

    $this->assertSoftDeleted($review->fresh);
});