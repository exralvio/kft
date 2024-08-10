<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Following extends Eloquent
{
    protected $collection = 'following';
}
