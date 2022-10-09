<?php

namespace StarfolkSoftware\Gauge\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Gauge\Reviewable;

class Item extends Model
{
    use HasFactory;
    use Reviewable;

    protected $table = 'items';
}