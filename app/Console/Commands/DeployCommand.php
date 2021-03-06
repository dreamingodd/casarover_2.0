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
        $dir = '/var/www/html/casarover_2.0/';
        /**
        * cache 会引发微信登陆错误，不知道为什么
        **/
        try {
            $commands = [
                "cd $dir",
                'git pull',
                // 'php artisan config:cache',
                // 'php artisan route:cache',
                // 'php artisan optimize --force'
            ];
            foreach ($commands as $value) {
                exec($value);
                Log::info($value);
            }
            return true;
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
