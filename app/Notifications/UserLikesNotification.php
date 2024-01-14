<?php

namespace App\Notifications;

use App\Models\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLikesNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $likeStore;

    /**
     * Create a new notification instance.
     */
    public function __construct($likeStore)
    {
        $this->likeStore = $likeStore;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Like on your post!.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->likeStore['post_id'],
            'user_id' => $this->likeStore['user_id'],
            'message' => 'Like on your post!',
            // 'email' => $this->likeStore['email'],
        ];
    }
}
