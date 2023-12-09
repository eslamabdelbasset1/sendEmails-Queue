<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $timeout = 7200;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return \Exception
     */
    public function handle()
    {


        try {

            $users = User::all();
            $input['title'] = $this->details['title'];
            $input['body'] = $this->details['body'];
            Log::channel('send_emails')->info("Prepare Messages For : {$users->count()} Users");

            foreach ($users as $user) {
                $input['name'] = $user->name;
                $input['email'] = $user->email;

                Log::channel('send_emails')->info('Prepare Message ');
                Mail::send('mail.test_mail', ['input' => $input], function ($message) use ($input) {
                    $message->to($input['email'], $input['name'])
                        ->subject($input['title']);
                });
                sleep(1);
                Log::channel('send_emails')->info('Message To ' . $user->email);


            }

        } catch (\Throwable $exception) {

            Log::channel('send_emails')->info("Error failed To Send For User : {$user->email} , Exception : " . $exception->getMessage());
        }

    }
}
