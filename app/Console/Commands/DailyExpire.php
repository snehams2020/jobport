<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;

class DailyExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        

     $jobs = Job::all();
        foreach ($jobs as $val) {
            if($val->till_date<=date('Y-m-d H:m:s')){
                Job::where('id',$val->id)->update([
                        'status'=>'0',
                 ]);
            }

           
        }
         
        $this->info('Successfully changed status.');
    }
}
