<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;

class updatajobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updatajobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update each job set is disactive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
