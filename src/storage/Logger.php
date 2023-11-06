<?php

namespace storage;

class ÎLogger
{
    public static function log($message)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timestamp = date('Y-m-d H:i:s');
        $fileName = __FILE__;
        $baseName = basename($fileName);
        $lineNumber = __LINE__;
        $text = "$timestamp: $baseName:$lineNumber - $message\n\n";
        file_put_contents('src/storage/history.txt', $text, FILE_APPEND);
    }
}