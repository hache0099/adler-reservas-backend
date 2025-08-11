<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordMail;

class SendPasswordChangeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct($detalles)
    {
        //
        $this->detalles = $detalles;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $mail = new PasswordMail(
            $this->detalles['id'],
            $this->detalles['name'],
            $this->detalles['token'],
        );
        Mail::to($this->detalles['email'])->send($mail);
    }
}
