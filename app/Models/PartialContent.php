<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PartialContent extends Eloquent
{
    protected $collection = 'partial_contents';

    protected $fillable = ['title', 'slug', 'content'];
}
