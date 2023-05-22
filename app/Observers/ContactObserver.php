<?php

namespace App\Observers;

use App\Models\Admins\Contact;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CustomerMessageNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class ContactObserver
{

    /**
     * Handle the Contact "created" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */

    public function created(Contact $contact)
    {
        $recipientEmail = 'rvr@arguss.lv';
        $notification = new CustomerMessageNotification($contact);
        Notification::route('mail', $recipientEmail)
            ->notify($notification);
        Notification::route('mail', $recipientEmail)
            ->notify($notification);
    }



    /**
     * Handle the Contact "updated" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function updated(Contact $contact)
    {
        //
    }

    /**
     * Handle the Contact "deleted" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        //
    }

    /**
     * Handle the Contact "restored" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function restored(Contact $contact)
    {
        //
    }

    /**
     * Handle the Contact "force deleted" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function forceDeleted(Contact $contact)
    {
        //
    }
}
