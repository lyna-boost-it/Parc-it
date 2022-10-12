<?php

namespace App\Notifications;

use App\Insurance;
use App\MoreNotifs;
use App\Vehicule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InsuranceNotification extends Notification
{
    use Queueable;
    public $insurance,$more_notifs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Insurance $insurance, MoreNotifs $more_notifs)
    {
        $this->insurance=$insurance;
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
        $vehicule=Vehicule::find($this->insurance->vehicle_id);
        $p=$vehicule->acquisition_date;
        return [
            'type'=>'insurance',
            'from'=>$p,
            'details'=>$this->more_notifs->details,
            'id'=>$this->insurance->id,
        ];
    }
}
