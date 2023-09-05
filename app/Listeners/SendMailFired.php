<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Mail;

class SendMailFired
{

    public $afterCommit = true;
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
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $data["client"] = $event->client->name;
        $data["email"] = $event->client->email;
        $data["title"] = config('app.name') . ' alkalmazás!';
        $data["body"] = config('app.name') . ' alkalmazás új '. $event->text;
        $data["datum"] = date('Y-m-d');

        Mail::send($event->mail, $data, function($message) use($event, $data) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"]);

            foreach ($event->files as $file) {
                $message->attach($file);
            }

        });
    }
}
