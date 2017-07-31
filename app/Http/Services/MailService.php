<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{

    public function sendEmail($data)
    {
        try
        {
          Mail::send('emails.send', ['data' => $data], function ($message) use ($data) {
            $message->from(env('MAIL_USERNAME'), env('MAIL_ENTERPRISE'));
            $message->subject($data['subject'] . ' ' . date('d/m/Y'))
                ->replyTo(env('MAIL_USERNAME'), env('MAIL_ENTERPRISE'));
            $message->to($data['email']);
          });
        }
        catch (\Exception $e)
        {
          return [
              'status' => 'error',
              'message' => $e->getMessage()
          ];
        }
    }
}
