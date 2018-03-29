<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Notification extends Eloquent
{
    protected $collection = 'notification';

    protected $fillable = ['sender', 'receiver', 'type', 'content', 'is_read','media'];
}
