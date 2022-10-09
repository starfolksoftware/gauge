<?php

namespace StarfolkSoftware\Gauge\Tests\Mocks;

use StarfolkSoftware\Gauge\Review as GaugeReview;

class Review extends GaugeReview
{
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ReviewFactory::new();
    }
}