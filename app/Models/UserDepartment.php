<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserDepartment extends Eloquent
{
    protected $collection = 'user_departments';
}
