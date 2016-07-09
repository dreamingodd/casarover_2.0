<?php

namespace App\Console\Commands;

use Config;
use DB;
use Log;
use Exception;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Delete db rows - 时间在 二维码过期时间*2 以前的
 * Delete QR files - 今天以前的（so 自动执行的时间点最好不要在 00:00）
 */
class PcLoginCleanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ywd:loginclean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean pc login request table and QR images.';

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
            // 1. Delete db rows.
            $now = new Carbon();
            $timePoint = $now->subSeconds(Config::get('casarover.pc_wx_expire_duration') * 2);
            $rowCount = DB::table('pc_login_request')->where('created_at', '<', $timePoint)->delete();

            // 2. Delete QR image files.
            $qrFolder = public_path() . "/assets/phpqrcode/temp";
            $fileCount = 0;
            $files = scandir($qrFolder);
            foreach($files as $file) {
                // starting with pclogin is Pc Login Request image file
                // !Attention! == is wrong for reason I don't know at this point.
                if (strpos($file, 'pclogin') === 0) {
                    $dateStr = substr($file, -12, 8);
                    $todayStr = $now->format("Ymd");
                    // echo $dateStr . "-" . $todayStr . "\n";
                    if ($dateStr != $todayStr) {
                        // chmod($file, 0777);
                        $path = public_path() . "/assets/phpqrcode/temp/" . $file;
                        unlink($path);
                        $fileCount++;
                    }
                }
            }
            Log::info(get_class() . ' - Deleted : Row:' . $rowCount . ", File:" . $fileCount);
        } catch (Exception $e) {
            Log::error(get_class() . ' - ' . $e);
        }
    }
}
