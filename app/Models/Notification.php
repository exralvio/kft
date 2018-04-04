<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Notification extends Eloquent
{
    protected $collection = 'notifications';

    protected $fillable = ['sender', 'receiver', 'type', 'is_read','media'];
}
