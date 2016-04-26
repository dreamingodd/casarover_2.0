<?php

namespace App\Console\Commands\Processors;

use App\Console\Commands\Processors\FileUtils;
use Illuminate\Support\Str;

class LineCounter {
    /** File types which would be counted. */
    private static $fileTypes = [
        '.php',
        '.js',
        '.less',
    ];
    /** File in this list must be included.
     * ##Only File.
     */
    private static $whiteList = [
        "/config/casarover.php",
    ];
    /** Folder or file in this list will be excluded. */
    private static $blackList = [
        "/tests/Countline.php",
        "/bootstrap",
        "/config",
        "/public",
        "/storage",
        "/vendor",
        "/server.php",
        "/app/Console",
        "/app/Providers/AppServiceProvider.php",
        "/app/Providers/AuthServiceProvider.php",
        "/app/Providers/EventServiceProvider.php",
        "/app/Providers/RouteServiceProvider.php",
        "/app/Http/Controllers/Auth/AuthController.php",
        "/app/Http/Controllers/Auth/PasswordController.php",
        "/app/Http/Middleware/Authenticate.php",
        "/app/Http/Middleware/EncryptCookies.php",
        "/app/Http/Middleware/RedirectIfAuthenticated.php",
        "/app/Http/Middleware/VerifyCsrfToken.php",
        "/node_modules",
        "/gulpfile.js",
        "/resources/assets/js/integration",
        "/app/oss",
    ];
    private static $codeLineCount = 0;
    private static $commentLineCount = 0;
    private static $whiteLineCount = 0;

    public static function count($path)
    {
        // convert black list and white list to full path.
        $blackList = $whiteList = [];
        foreach (LineCounter::$blackList as $apath) {
            array_push($blackList, $path . $apath);
        }
        foreach (LineCounter::$whiteList as $apath) {
            array_push($whiteList, $path . $apath);
        }
        // Exclude the folers in blackList.
        $files = FileUtils::listAllFiles($path, $blackList);
        $actualFiles = [];
        // exclude folders and unmentioned file types.
        foreach ((array) $files as $file) {
            $typeInclude = false;
            foreach (LineCounter::$fileTypes as $fileType) {
                if (Str::endsWith($file, $fileType)) {
                    $typeInclude = true;
                }
            }
            if ($typeInclude && is_file($file)) {
                array_push($actualFiles, $file);
            }
        }
        // exclude black list and include white list
        $includeFiles = [];
        foreach ($actualFiles as $file) {
            $black = false;
            $white = false;
            foreach ($whiteList as $whitePath) {
                if (Str::startsWith($file, $whitePath)) {
                    $white = true;
                }
            }
            if (!$white) {
                foreach ($blackList as $blackPath) {
                    if (Str::startsWith($file, $blackPath)) {
                        $black = true;
                    }
                }
            }
            // echo (int) $white . ' ' .(int) $black . ' ' .$file . "\n";
            if ($white || !$black) {
                array_push($includeFiles, $file);
            }
        }
        // count the included files.
        foreach ($includeFiles as $file) {
            LineCounter::countFile($file);
        }
        foreach ($whiteList as $file) {
            if (!in_array($file, $includeFiles) && file_exists($file)) {
                LineCounter::countFile($file);
            }
        }
        echo "Files  :".count($includeFiles)."\n";
        echo "Code   :".self::$codeLineCount."\n";
        echo "Comment:".self::$commentLineCount."\n";
        echo "White  :".self::$whiteLineCount."\n";
    }

    /**
    * Count lines for a file.
    */
    public static function countFile($filepath)
    {
        $contents = file_get_contents($filepath);
        $lines = explode("\n", $contents);
        $enterComment = false;
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || $line === "{" || $line === "}") {
                 self::$whiteLineCount++;
            } else if ($enterComment) {
                self::$commentLineCount++;
                if (Str::endsWith($line, "-->") || Str::endsWith($line, "*/")) {
                    $enterComment = false;
                }
            } else if ((Str::startsWith($line, "<!--") && Str::endsWith($line, "-->"))
                    || (Str::startsWith($line, "/*")  && Str::endsWith($line, "*/"))) {
                self::$commentLineCount++;
            } else if (Str::startsWith($line, "//")) {
                self::$commentLineCount++;
            } else if ((Str::startsWith($line, "<!--") && !Str::endsWith($line, "-->"))
                    || (Str::startsWith($line, "/*")  && !Str::endsWith($line, "*/"))) {
                self::$commentLineCount++;
                $enterComment = true;
            } else {
                self::$codeLineCount++;
            }
        }
    }
}