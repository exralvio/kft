<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NotificationController  extends Controller{

    public function loadNotificationContent(){
        $html = '';
        $myNotifications = \NotificationHelper::getNotification();
        if(!empty($myNotifications)){
            foreach($myNotifications as $notif){
                if(isset($notif->sender['photo'])){
                    $photo = url($notif->sender['photo']);
                }else{
                    $photo = url('/images/pp-icon.png');
                }
                $sender_photo = "<span class='nav-avatar'><img src=".$photo."></span>";
                $sender = "<a href=".url("/profile/{$notif->sender['id']}")."><b>".$notif->sender['firstname']." ".$notif->sender['lastname']."</b></a>";
                $action = '';
                $media = '';
                switch($notif->type){
                    case 'like': $action = ' liked ';break; 
                    case 'comment': $action = ' commented '; break;
                    case 'follow': $action = ' followed you now'; break;
                }
                if(!empty($notif->media)){
                    $media = "<a href=".url("/media/{$notif->media['id']}")."><b>".$notif->media['title']."</b></a>";
                }
                $html .= "<li>"."<div class='pull-left'>".$sender_photo."</div><div style='display:table;padding-left: 5px;'>".$sender.$action.$media."</div></li>";
            }
        }
        echo $html;
    }

}