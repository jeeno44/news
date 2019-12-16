<?php

namespace App\Listeners;

use App\Events\LoggingPostEnevt;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoggingPostEnevtListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LoggingPostEnevt $event)
    {
        Log::create([
            "datetime"          => Carbon::now()->toDateTimeString(),
            "event"             => $event->sob,
            "author_id"         => $event->user,
            "post_id"           => $event->postId
        ]);
    }
}
