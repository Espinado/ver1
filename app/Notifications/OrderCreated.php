<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Vonage\SMS\Message\Simple;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;

class OrderCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toVonage($notifiable)
    {
       $basic  = new \Vonage\Client\Credentials\Basic("e2150a5a", "MWcfcGSwbinezJ8a");
            $client = new \Vonage\Client($basic);
            $response = $client->sms()->send(new \Vonage\SMS\Message\SMS('+37126161034', 'Arguss shop', 'Order Nr.' ));

        return $response;
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your order has been created')
            ->from('rvr@arguss.lv', 'Arguss shop')
             ->markdown('emails.order', ['data' => $this->data]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
