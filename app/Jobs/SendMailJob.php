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
use App\Consts\ScreenConst;
use App\Models\JobWork;
use App\Traits\LogTrait;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    private $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger("sendmail");
        $this->sendEmail();
    }

    private function getMailData()
    {
        $jobData = JobWork::where('id', '=', $this->request['id'])->first();
        $genderName = "";
        switch ($this->request['gender']) {
            case ScreenConst::GENDER_FEMALE:
                $genderName = 'chị';
                break;
            case ScreenConst::GENDER_MALE:
                break;
                $genderName = 'anh';
            default:
                $genderName = 'anh/chị';
                break;
        }
        // Send Email
        $mailData = [
            'candidates_name' => $this->request['first_name'] . ' ' . $this->request['last_name'],
            'job_name'        => $jobData->job_name,
            'gender'          => $genderName,
            'sender_name'     => \env('MAIL_SENDER_NAME'),
        ];
        return $mailData;
    }

    private function sendEmail()
    {
        try {
            $mailData = $this->getMailData();
            logger($mailData);
            Mail::to($this->request['email'])->send(new SendMailApplySuccess($mailData));
        } catch (\Exception $ex) {
            logger($ex);
            $this->errorLog('E0001', 'Gửi email');
        }
    }
}
