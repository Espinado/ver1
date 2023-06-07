<?php

namespace App\Observers;

use App\Models\Customers\Order;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderNotification;
use App\Notifications\AdminOrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
use App\Models\User;
use App\Notifications\OrderStatusUpdatedNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        // $recipients = ['rvr@arguss.lv', 'roman.vyshedko'];

        $order->notify(new OrderNotification($order));
        // Notification::route('mail', 'admin@arguss.lv')
        // ->notify(new AdminOrderNotification($order));


    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $order->notify(new OrderStatusUpdatedNotification($order));
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
