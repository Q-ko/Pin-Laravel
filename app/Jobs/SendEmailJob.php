<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendPostNewClient;
use App\Mail\SendPostNewComment;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mailClass;
    protected $details;

    public function __construct($mailClass, $details)
    {
        $this->mailClass = $mailClass;
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to('mundose.comentario.pin@gmail.com')->send(new $this->mailClass($this->details));
    }
}