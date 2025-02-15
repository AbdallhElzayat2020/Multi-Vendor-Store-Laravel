<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("New Order #{$this->order->number}") // name of Message by default name of Class
//            ->from('notification@gmail.com', 'MultiVendor Store')
            ->greeting("Hi {$notifiable->name},")
            ->line("A New Order #{$this->order->number} Created By {$addr->name} From {$addr->country}") // country name is not exists in database it's from association
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!');

        //->view('mail.order-created');
    }

    public function toDatabase($notifiable)
    {
        $addr = $this->order->billingAddress;
        return [
            'body' => "New Order #{$this->order->number} By {$addr->name} from {$addr->country}",
            'icon' => "bi bi-info-circle text-primary",
            'url' => "/dashboard",
            'order_id' => $this->order->id,
        ];

    }
//BROADCAST
    public function toBroadcast($notifiable)
    {
        $addr = $this->order->billingAddress;
        return new BroadcastMessage ([
            'body' => "New Order #{$this->order->number} By {$addr->name} from {$addr->country}",
            'icon' => "bi bi-info-circle text-primary",
            'url' => "/dashboard",
            'order_id' => $this->order->id,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
