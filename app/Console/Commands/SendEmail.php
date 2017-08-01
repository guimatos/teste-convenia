<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Queue;
use App\Jobs\EmailQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:salesresume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email with sales resume.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
     public function handle()
     {
         try
         {
            $sellers = app('App\Http\Repositories\Eloquent\SellerRepository');
            // Inicia instancia de filas
            app('queue.connection');
            foreach ($sellers->getSellersWithSales() as $key => $value)
            {
              $data = array(
                'title' => 'RESUMO DE VENDAS' . date('d/m/Y'),
                'subject' => 'RESUMO DE VENDAS' . date('d/m/Y'),
                'email' => $value['email'],
                'seller' => $value['name'],
                'comission' => $value['comission']
              );

              Mail::queue('emails.send', ['data' => $data], function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'), env('MAIL_ENTERPRISE'));
                $message->subject($data['subject'])
                ->replyTo(env('MAIL_USERNAME'), env('MAIL_ENTERPRISE'));
                $message->to($data['email']);
              });
            }
            return $this->info('Resume of sales sended!');
         }
         catch (\Exception $e)
         {
            return $this->error('Something went wrong!', $e->getMessage());
         }
     }
}
