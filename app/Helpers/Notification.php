<?php

namespace App\Helpers;

Use App\Models\Notification;
Use App\Models\User;

Class NotificationHelper{

    /**
     * {
     *   "sender":"string of id",
     *   "receiver":"string of id",
     *   "type":"string",
     *   "content":"string",
     *   "is_read":"boolean",
     *   "created_at":"timestamp"
     * }
    */
    public static function setNotification($notification){
        $newNotification = new Notification;
        $newNotification = $notification;
        $newNotification->save();
    }
    
    public static function getNotification($notification){
        $user = User::current();
        $notification = Notification::where('receiver','=',$user['_id'])->get();
        return $notification;
    }

}