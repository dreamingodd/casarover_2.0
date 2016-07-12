<?php

namespace App\Console\Commands;

use Log;
use Exception;
use Illuminate\Console\Command;

class DbBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ywd:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup DB in sql file, only for Production.';

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
            $prevSqlFile = "/home/back/db_backup.sql";
            $postSqlFile = "/home/back/db_backup_" . date("Ymd_hms") . ".sql";
            $shellFile = "/home/back/db_backup.sh";
            // Commands.
            $delSqlCommand = "rm -f " . $prevSqlFile;
            $backupCommand = "sudo " . "/home/back/db_backup.sh";
            $renameCommand = "mv " . $prevSqlFile . " " . $postSqlFile;
            // Check shell existence.
            if (!file_exists($shellFile)) {
                throw Exception("DB Backup Shell doesn't exist.");
            }
            // Delete sql file if exists.
            if (file_exists($prevSqlFile)) {
                exec($delSqlCommand, $outputArray, $returnVal);
            }
            // Execute backup shell.
            exec($backupCommand, $outputArray, $returnVal);
            foreach ($outputArray as $line) {
                Log::info(get_class() . ' - ' . $line);
            }
            if ($returnVal) {
                Log::info(get_class() . '执行失败！');
                return;
            }
            // Rename file.
            exec($renameCommand, $outputArray, $returnVal);
            // Send email.
            
        } catch (Exception $e) {
            Log::error(get_class() . ' - ' . $e);
        }
    }
}
