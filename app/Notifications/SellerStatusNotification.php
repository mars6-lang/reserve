<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class SellerStatusNotification extends Notification
{
    use Queueable;

    protected $status; // ✅ This should be 'status', not 'action'

    public function __construct($status)
    {
        $this->status = $status; // ✅ Store it correctly
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // You removed 'mail' earlier — good
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $messages = [
            'warned' => 'I got my eye on you, you have been warned.',
            'suspended' => 'You are grounded, you are grounded my nigga for a while.',
            'banned' => 'Ok thats enough you son of a bitch, you are permanently banned.',
        ];

        return [
            'title' => ucfirst($this->status),
            'message' => $messages[$this->status] ?? 'You have a new notification.',
        ];
    }
}
