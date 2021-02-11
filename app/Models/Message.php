<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use Notifiable;

    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_HOOK');
    }
}
