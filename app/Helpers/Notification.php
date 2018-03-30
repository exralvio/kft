<?php

namespace App\Helpers;

Use App\Models\Notification;
Use App\Models\User;

Class NotificationHelper{

    /* {
        "sender":{
            "id": "objid",
            "firstname": "string",
            "lastname": "string",
            "photo": "string"
        },
        "receiver":"objid",
        "type":"like|comment|follow",
        "content":"string",
        "is_read":"boolean",
        "created_at":"timestamp"
    } */
    public static function setNotification($notification){
        if($notification['sender'] != $notification['receiver'] ){
            $notification['is_read'] = false;
            Notification::create($notification);
        }
    }
    
    public static function getNotification(){
        $user = User::current();
        $notification = Notification::where('receiver','=',$user['_id'])
                        ->orderBy('created_at', 'desc')
                        ->orderBy('is_read', 'desc')
                        ->get();
        return $notification;
    }
    
    public static function getUnreadNotification(){
        $user = User::current();
        $notification = Notification::where('receiver','=',$user['_id'])
                        ->where('is_read',false)
                        ->count();
        return $notification;
    }

}