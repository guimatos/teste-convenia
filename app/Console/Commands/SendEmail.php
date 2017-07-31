<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Queue;
use App\Jobs\EmailQueue;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send resume email.';

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
          dispatch(new EmailQueue);
          return $this->info('Create email!');
        }
        catch (Exception $e)
        {
          $this->error('Something went wrong!', $e->getMessage());
        }
     }
}
