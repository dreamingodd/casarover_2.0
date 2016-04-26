<?php

namespace App\Console\Commands\Processors;

use App\Console\Commands\Processors\LineCounter;

/**
 *
 */
trait Countline
{

    /**
     * Must be put in the folder like project/tests
     */

    // 结尾不能加反斜杠
    // LineCounter::count("/Applications/XAMPP/xamppfiles/htdocs/php_oop");
    public function countline()
    {
        $projectPath = __DIR__;
        if (PHP_OS == "Darwin" || PHP_OS == "Linux") {
            $projectPath = str_replace('/app/Console/Commands/Processors', '', $projectPath);
        } else {
            $projectPath = str_replace("\\app\\Console\\Commands\\Processors", '', $projectPath);
        }
        // Print project path for counting.
        echo "Path: " . $projectPath . "\n";
        LineCounter::count($projectPath);
        // Countor::count(__FILE__);
        // var_dump(FileUtils::listAllFiles("/Applications/XAMPP/xamppfiles/htdocs/casarover_2.0/database"));
        // var_dump(FileUtils::listAllFiles(__FILE__));
        echo "\n";
    }
}
