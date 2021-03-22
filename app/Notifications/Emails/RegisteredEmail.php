<?php

namespace App\Notifications\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Email address verification url that has to be send with this email
     * notification.
     * 
     * @var string
     */
    private $verify_url;

    /**
     * Creates a new email notification that sends account registered notification,
     * with a link to verify the registered email address.
     * 
     * @param string $verify_url
     */
    public function __construct($verify_url)
    {
        $this->verify_url = $verify_url;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to the Zerodrop family')
            ->view('email.verification', ['verify_url' => $this->verify_url]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [$this->verify_url];
    }
}
