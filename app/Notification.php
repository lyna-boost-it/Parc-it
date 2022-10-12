<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    public function users()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
}
