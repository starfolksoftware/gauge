<?php

namespace StarfolkSoftware\Gauge\Tests\Mocks;

use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    protected $table = 'users';
}
