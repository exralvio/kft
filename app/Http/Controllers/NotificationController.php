<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Response;
use App\Models\Media;
use App\Models\User;

class NotificationController  extends Controller{

    public function loadNotificationContent(){
        $html = '';
        $loadedCommentIds = [];
        $myNotifications = \NotificationHelper::getNotification();
        if(!empty($myNotifications)){
            foreach($myNotifications as $notif){
                array_push($loadedCommentIds, $notif->_id);
                
                $content = $this->notificationContent($notif);

                $html .= "<li>";
                $html .= "<a href='".url($notif['type'] == 'follow' ? 'user/'.$notif['sender']['id'] : 'media/'.$notif['media']['id'])."'>";
                $html .= '<span class="sender-photo"><img src="'.url($content['first_photo']).'"></span>';
                if(!empty($content['last_photo'])){
                    $html .= '<span class="receiver-photo"><img src="'.url($content['last_photo']).'"></span>';
                }
                $html .= '<div>'.$content['message'].'</div></a>';
                $html .= "</li>";
            }
        }

        /**
         * set all opened notification as read
        */
        Notification::whereIn('_id', $loadedCommentIds)->update(['is_read'=>true]);

        echo $html;
    }

    public function notificationContent($notif){
        $msg = '';
        $first_photo = '';
        $last_photo = '';

        $head = "<b>".$notif->sender['fullname']."</b>";
        $tail = '';

        $media = !empty($notif->media) ? Media::find($notif->media['id']) : [];

        $action = $notif->type;

        switch ($action) {
            case 'like':
                $msg = ' liked ' ;
                $first_photo = !empty($notif->sender['photo']) ? $notif->sender['photo'] : url('/images/pp-icon.png');

                if($media){
                    $last_photo = isset($media->images['small']) ? $media->images['small'] : $media->images['medium'];
                    $tail = "<b>".$notif->media['title']."</b>";
                } else {
                    $tail = 'Deleted Photo';
                }
                
                break;
            case 'comment':
                $msg = ' commented ' ;
                $first_photo = !empty($notif->sender['photo']) ? $notif->sender['photo'] : url('/images/pp-icon.png');

                if($media){
                    $last_photo = isset($media->images['small']) ? $media->images['small'] : $media->images['medium'];
                    $tail = "<b>".$notif->media['title']."</b>";
                } else {
                    $last_photo = url('images/not-found.jpg');
                    $tail = 'Deleted Photo';
                }

                break;
            case 'follow':
                $msg = ' followed you now' ;
                $first_photo = !empty($notif->sender['photo']) ? $notif->sender['photo'] : url('/images/pp-icon.png');
                $last_photo = !empty($notif->receiver['photo']) ? $notif->receiver['photo'] : url('/images/pp-icon.png');
                $tail = '';
                break;
            case 'popular':
                $msg = ' Your photo is Popular ';
                $first_photo = !empty($notif->sender['photo']) ? $notif->sender['photo'] : url('/images/pp-icon.png');
                if($media){
                    $last_photo = isset($media->images['small']) ? $media->images['small'] : $media->images['medium'];
                } else {
                    $tail = 'Deleted Photo';
                }
                break;
        }

        $message = $head.$msg.$tail;

        return compact('message','first_photo','last_photo');
    }

    public function unreadNotification(){
        $count = \NotificationHelper::getUnreadNotification();
        return Response::json(['status'=>'success', 'unread_notification'=> $count],200);
    }

}