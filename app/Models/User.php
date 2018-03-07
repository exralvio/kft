<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Eloquent implements Authenticatable
{
    protected $collection = 'users';
}
