<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MediaCategory extends Eloquent
{
    protected $collection = 'media_categories';
}
