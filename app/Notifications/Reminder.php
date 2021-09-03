<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Reminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, $ssname)
    {
        $this->id = $id;
        $this->ssname = strtolower($ssname);
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
        $url = 'http://127.0.0.1:8005/add_your_report/' . $this->id;

        return (new MailMessage)
            ->subject($this->ssname . " Reminder to fill your report")
            ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
            ->line('تذكير بكتابة التقرير')
            ->action('عرض المهمة', $url)
            ->line('   قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ');
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
