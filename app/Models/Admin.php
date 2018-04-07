<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\ObjectID;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPassword;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Authenticatable implements CanResetPasswordContract{

    use Notifiable, CanResetPassword;
    protected $collection = 'admins';
}