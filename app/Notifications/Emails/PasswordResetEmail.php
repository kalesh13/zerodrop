<?php

namespace App\Notifications\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The password reset url.
     * 
     * @var string
     */
    public $reset_url;

    /**
     * Creates a new password reset email notification for the given reset url.
     * 
     * @param string $reset_url
     */
    public function __construct($reset_url)
    {
        $this->reset_url = $reset_url;
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
            ->subject('Reset Password Notification')
            ->view('email.reset', ['reset_url' => $this->reset_url]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [$this->reset_url];
    }
}
