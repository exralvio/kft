<?php

namespace App\Helpers;

Use App\Models\Notification;
Use App\Models\User;

Class NotificationHelper{

    public static function setNotification($type, $sender_id, $receiver_id, $media=[]){
        $sender = User::raw()->findOne(['_id'=>$sender_id]);
        $receiver = User::raw()->findOne(['_id'=>$receiver_id]);

        $input = [
            'type'=>$type,
            'sender'=>[
                'id'=>$sender['_id'],
                'fullname'=>$sender['fullname'],
                'photo'=>$sender['photo']
            ],
            'receiver'=>[
                'id'=>$receiver['_id'],
                'fullname'=>$receiver['fullname'],
                'photo'=>$receiver['photo']
            ],
            'media'=>$media,
            'is_read'=>false
        ];

        Notification::create($input);
    }
    
    public static function getNotification(){
        $user = User::current();
        $notification = Notification::where('receiver.id', $user['_id'])
                        ->orderBy('created_at', 'desc')
                        ->orderBy('is_read', 'desc')
                        ->get();
        return $notification;
    }
    
    public static function getUnreadNotification(){
        $user = User::current();
        $notification = Notification::where('receiver.id', $user['_id'])
                        ->where('is_read',false)
                        ->count();
        return $notification;
    }

}