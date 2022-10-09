<?php

namespace StarfolkSoftware\Gauge\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Gauge\TeamHasReviews;

class Team extends Model
{
    use TeamHasReviews;

    protected $table = 'teams';
}