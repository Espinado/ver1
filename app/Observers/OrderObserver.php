<?php

namespace App\Observers;

use App\Models\Customers\Order;
use Illuminate\Database\Eloquent\Observers\Observer;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Customers\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
       dd('a');
    }
    public function creating(Order $order)
    {
        dd('a');
    }


    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Customers\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        dd('Order updated!', $order);
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Customers\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Customers\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Customers\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
