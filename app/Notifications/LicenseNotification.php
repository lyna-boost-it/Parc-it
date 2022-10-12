<?php

namespace App\Notifications;

use App\DrivingLicence;
use App\MoreNotifs;
use App\Vehicule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LicenseNotification extends Notification
{
    use Queueable;
    public $license,$more_notifs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DrivingLicence $license, MoreNotifs $more_notifs)
    {
        $this->license=$license;
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
        $vehicule=Vehicule::find($this->license->vehicle_id);
        $p=$vehicule->acquisition_date;
        return [
            'type'=>'license',
            'from'=>$p,
            'details'=>$this->more_notifs->details,
            'id'=>$this->license->id,
        ];
    }
}
