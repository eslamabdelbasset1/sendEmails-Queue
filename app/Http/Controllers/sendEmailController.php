<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class sendEmailController extends Controller
{
    public function form()
    {
        return view('send_emails_form');
    }

    public function send_emails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $details = [
            'title' => $request->title,
            'body' => $request->body,
        ];

        dispatch(new SendMailJob($details));

//        Log::channel('send_emails')->info('send_emails',[
//            'jobs' => $job,
//        ]);

        return back()->with('status', 'Mails sent successfully');

    }
}
