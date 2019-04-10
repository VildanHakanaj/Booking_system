<?php

namespace App\Notifications;

use function GuzzleHttp\Psr7\str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Booking;

class VerifyBooking extends Notification
{
    use Queueable;
    public $user;
    public $booking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Booking $booking)
    {
        $this->user = $user;
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $check_in_time = new \App\CheckInTimes;
        $startTimes = $check_in_time->where('day', '=', date('l', strtotime($this->booking->start_date)))->get()->pluck('hours');
        $endTimes = $check_in_time->where('day', '=', date('l', strtotime($this->booking->end_date)))->get()->pluck('hours');
        return (new MailMessage)
            ->line('You have successfully booked ' . $this->booking->kit->title)
            ->line('Pick up date is on ' . date('D', strtotime($this->booking->start_date)) . ' Time slots: ' . $startTimes)
            ->line('Return date is on ' . date('D', strtotime($this->booking->end_date)) . ' Time slots: ' . $endTimes)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
