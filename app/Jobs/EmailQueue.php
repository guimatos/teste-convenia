<?php

namespace App\Jobs;

// use App\Http\Repositories\Eloquent\SellerRepository;

use Illuminate\Support\Facades\Mail;
use App\Jobs\Job;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailQueue extends Job implements SelfHandling, ShouldQueue
{

    public $seller;

    /**
     * Create a new job instance.
     *
     * @param  SellerRepository  $seller
     * @return void
     */
    public function __construct()
    {
        // $this->seller = $seller;
    }

    /**
     * Execute the job.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function handle()
    {
      try
      {
        $sellers = app('App\Http\Respositories\Eloquent\SellerRepository');

        foreach ($sellers as $key => $value)
        {
            $data = array(
              'title' => 'RESUMO DE VENDAS',
              'subject' => 'RESUMO DE VENDAS',
              'email' => $value['email'],
              'comission' => $value['comission'],
              'amount' => 19,
            );

            Mail::queue('emails.send', ['data' => $data], function ($message) use ($data) {
              $message->from(env('MAIL_USERNAME'), env('MAIL_ENTERPRISE'));
              $message->subject($data['subject'] . ' ' . date('d/m/Y'))
                  ->replyTo(env('MAIL_USERNAME'), env('MAIL_ENTERPRISE'));
              $message->to($data['email']);
            });
        }

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
