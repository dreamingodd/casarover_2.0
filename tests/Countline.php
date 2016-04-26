<?php
/**
 * Must be put in the folder like project/tests
 */

// 结尾不能加反斜杠
// Countline::count("/Applications/XAMPP/xamppfiles/htdocs/php_oop");
$projectPath = __DIR__;
if (PHP_OS == "Darwin" || PHP_OS == "Linux") {
    $projectPath = str_replace('/tests', '', $projectPath);
} else {
    $projectPath = str_replace("\\tests", '', $projectPath);
}
// Print project path for counting.
echo "Path: " . $projectPath . "\n";
Countline::count($projectPath);
// Countline::count(__FILE__);
// var_dump(FileUtils::listAllFiles("/Applications/XAMPP/xamppfiles/htdocs/casarover_2.0/database"));
// var_dump(FileUtils::listAllFiles(__FILE__));
echo "\n";

class Countline {
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

    public static function count($path) {
        // convert black list and white list to full path.
        $blackList = $whiteList = [];
        foreach (Countline::$blackList as $apath) {
            array_push($blackList, $path . $apath);
        }
        foreach (Countline::$whiteList as $apath) {
            array_push($whiteList, $path . $apath);
        }
        // Exclude the folers in blackList.
        $files = FileUtils::listAllFiles($path, $blackList);
        $actualFiles = [];
        // exclude folders and unmentioned file types.
        foreach ((array) $files as $file) {
            $typeInclude = false;
            foreach (Countline::$fileTypes as $fileType) {
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
            Countline::countFile($file);
        }
        foreach ($whiteList as $file) {
            if (!in_array($file, $includeFiles) && file_exists($file)) {
                Countline::countFile($file);
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
    public static function countFile($filepath) {
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

class FileUtils {
    public static function dirPath($path) {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') $path = $path . '/';
        return $path;
    }
    /**
     * Get all the file (and folder) under the top folder.
     * If $path is a file, will return the file.
     * To improve efficiency, I pass in $exclude_folders.
     */
    public static function listAllFiles($path, $exclude_folders = array(), $exts = '', $list = array()) {
        if (is_file($path)) {
            return $path;
        }
        $path = FileUtils::dirPath($path);
        $files = glob($path . '*');
        foreach($files as $v) {
            if (!$exts || preg_match("/\.($exts)/i", $v)) {
                $list[] = $v;
                if (is_dir($v) && !in_array($v, $exclude_folders)) {
                    $list = FileUtils::listAllFiles($v, $exclude_folders, $exts, $list);
                }
            }
        }
        return $list;
    }
}

class Str {

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }

        return false;
    }

}
