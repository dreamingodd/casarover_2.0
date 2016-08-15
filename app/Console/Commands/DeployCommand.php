<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deploy project';

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
        try {
            $commands = [
                'git pull',
                'php artisan config:cache',
                'php artisan optimize --force',
                'php artisan route:cache'
            ];
            foreach ($commands as $value) {
                exec($value);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
