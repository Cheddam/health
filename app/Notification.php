<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Notification extends Model
{
    public function subscribers()
    {
        return $this->belongsToMany('App\User', 'notification_subscriptions', 'user_id', 'notification_id');
    }
}
