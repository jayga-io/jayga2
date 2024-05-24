<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class SendBookingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $receipent;
    protected $subject;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($receipent, $subject, $data)
    {
        $this->receipent = $receipent;
        $this->subject = $subject;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::plain(
            view: 'mailTemplates.NewBookingRequest',
            data: $this->data,
            callback: function (Message $message){
                $message->to($this->receipent)->subject($this->subject);
            });
    }
}
