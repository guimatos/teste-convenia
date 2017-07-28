<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{

    public function sendEmail($email)
    {
        try {
          Mail::send('emails.send', ['title' => 'Mensagem Lumen', 'message' => 'Teste'], function ($message) {
            $message->from('no-reply@enterprise.com.br', 'Enterprise');
            $message->subject('Contato XXXX')
                ->replyTo('no-reply@enterprise.com.br', 'Enterprise');
            $message->to($email);
          });
        } catch (\Exception $e) {
          return [
              'status' => 'error',
              'message' => $e->getMessage()
          ];
        }
    }
}
