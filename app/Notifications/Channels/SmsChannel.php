<?php

namespace App\Notifications\Channels;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SmsChannel implements ShouldQueue
{
    use Queueable;

    public function send($notifiable, Notification $notification)
    {

    }
}