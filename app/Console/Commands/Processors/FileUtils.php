<?php

namespace App\Console\Commands\Processors;

class FileUtils {
    public static function dirPath($path)
    {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') $path = $path . '/';
        return $path;
    }
    /**
     * Get all the file (and folder) under the top folder.
     * If $path is a file, will return the file.
     * To improve efficiency, I pass in $exclude_folders.
     */
    public static function listAllFiles($path, $exclude_folders = array(), $exts = '', $list = array())
    {
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
