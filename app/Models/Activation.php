<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Activation extends Eloquent
{
    protected $collection = 'activation';
}
