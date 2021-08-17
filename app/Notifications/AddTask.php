<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;

class AddTask extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id,$imageName,$ssname)
    {
        $this->id = $id;
        $this->imageName = $imageName;
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
        $url = 'http://127.0.0.1:8001/add_your_report/'.$this->id;
        // $url = 'http://192.168.188.208:80/add_your_report/'.$this->id;

        return (new MailMessage)
        ->subject($this->ssname." مهمة جديدة لمحطة")
        ->from('psmdkwco@psmdkw.com', 'Protection Maintenance')
        ->line('اضافة مهمة جديدة')
        ->action('عرض المهمة', $url)
        ->line('   قسم الوقاية - ادارة صيانة محطات التحويل الرئيسية  ')
        ->attach(public_path('Attachments/'.$this->id.'/'.$this->imageName));
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