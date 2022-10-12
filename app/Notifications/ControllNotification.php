<?php

namespace App\Notifications;

use App\MoreNotifs;
use App\TechnicalControl;
use App\Vehicule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ControllNotification extends Notification
{
    use Queueable;
    public $controll,$more_notifs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TechnicalControl $controll, MoreNotifs $more_notifs)
    {
        $this->controll=$controll;
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
        $vehicule=Vehicule::find($this->controll->vehicle_id);
        $p=$vehicule->acquisition_date;
        return [
            'type'=>'controll',
            'from'=>$p,
            'details'=>$this->more_notifs->details,
            'id'=>$this->controll->id,
        ];
    }
}
