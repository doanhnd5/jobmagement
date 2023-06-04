<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\SendMailApplySuccess;
use App\Traits\LogTrait;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    public $mailData;

    /**
     * Create a new job instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->sendEmail();
    }

    private function sendEmail()
    {
        try {
            Mail::to($this->mailData['mail'])->send(new SendMailApplySuccess($this->mailData));
        } catch (\Exception $ex) {
            $this->errorLog('E0001', 'Gửi email');
        }
    }
}
