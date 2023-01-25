<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\Tender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserForgotPassword extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user_email;
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_email, $token)
    {
        $this->user_email = $user_email;
        $this->token = $token;
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
        $url = '/reset-password/' . $this->token;
        return (new MailMessage)
                    ->subject('Cấp lại mật khẩu Tender - Hồng Hà Bình Định')
                    ->line('Bạn vừa yêu cầu cấp lại mật khẩu cho ' . $this->user_email . '. Bạn hãy ấn nút dưới đây.')
                    ->action('Yêu cầu cấp mật khẩu', url($url))
                    ->line('Xin cảm ơn!');
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
