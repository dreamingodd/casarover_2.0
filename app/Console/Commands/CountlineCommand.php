<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\Processors\Countline;

class CountlineCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ywd:countline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will display line info for all developed js/php files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    use Countline;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->countline();
    }
}
