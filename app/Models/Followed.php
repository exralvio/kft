<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Followed extends Eloquent
{
    protected $collection = 'followed';
}
