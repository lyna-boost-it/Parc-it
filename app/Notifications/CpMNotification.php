<?php

namespace App\Notifications;

use App\Material;
use App\MoreNotifs;
use App\PieceMaterial;
use App\Vehicule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CpMNotification extends Notification
{
    use Queueable;
    public $cp,$more_notifs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PieceMaterial $cp, MoreNotifs $more_notifs)
    {
        $this->cp=$cp;
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
        $vehicule=Material::find($this->cp->mm_id);
        $p=$vehicule->acquisition_date;
        return [
            'type'=>'maintenance',
            'from'=>$p,
            'details'=>$this->more_notifs->details,
            'id'=>$this->cp->id,
        ];
    }
}
