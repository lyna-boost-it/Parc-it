<?php

namespace App\Notifications;

use App\Mission;
use App\MoreNotifs;
use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionNotification extends Notification
{
    use Queueable;
    public $mission,$more_notifs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mission $mission, MoreNotifs $more_notifs)
    {
        $this->mission=$mission;
         $this->more_notifs=$more_notifs;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $mission=Mission::find($this->mission->id);
        $staff=Staff::find($mission->driver_id);
        $p=$staff->name.' '.$staff->last_name;

        return [
            'type'=>'mission',
            'from'=>$p,
            'details'=>$this->more_notifs->details,
            'id'=>$this->mission->id,
        ];
    }
}
