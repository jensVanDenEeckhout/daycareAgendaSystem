<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everyWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'week:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will undo all done tasks';

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
        //
        $affected = DB::table('cells')->where('task_done', '=', 1)->update(array('task_done' => 0));
        echo "operation done";
        \Log::info('Succesfull restore' . \Carbon\Carbon::now());
    }
}
