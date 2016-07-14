<?php

namespace App\Console\Commands;

use Log;
use Mail;
use Config;
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
            $postSqlFile = "/home/back/db_backup/db_backup_" . date("Ymd_hms") . ".sql";
            $shellFile = "/home/back/db_backup.sh";
            // Commands.
            $delSqlCommand = "rm -f " . $prevSqlFile;
            $backupCommand = "sudo " . $shellFile;
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
            Log::info(get_class() . ' - '
                    . 'DB backup file is sending to mail addresses which are defined in config/config.php');
            Mail::send('email.dbBackup', ['postSqlFile' => $postSqlFile], function ($m) use ($postSqlFile) {
                $m->from('alwayslookback@163.com', 'Casarover');
                $m->attach($postSqlFile);
                foreach (Config::get('config.system_mail_receivers') as $receiver) {
                    $m->to($receiver['address'], $receiver['name'])->subject('Casarover DB Backup!');
                }
            });
        } catch (Exception $e) {
            Log::error(get_class() . ' - ' . $e);
        }
    }
}
