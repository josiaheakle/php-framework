<?php

namespace app\utils;

class Util {

    /**
     * Clears file in path
     */
    public static function clearDebug(string $path)
    {
        $fstream = fopen($path, 'w');
        fwrite($fstream, '');
        fclose($fstream);
    }

    /**
     * Util
     *s to first argument as path
     * ---
     * @param mixed $args -> array, string, object
     * @param string $path 
     * @return bool true on success
     */
    public static function logDebug($args, string $path = 'DEBUG.txt') : bool
    {
        $fileStream = fopen($path, 'a');
        $dateNow = self::dateNow();
        ob_start();
        echo "\n\n[" . $dateNow . "] ========================================================================= \n";
        var_dump($args);
        echo "\n---\n";
        fwrite($fileStream, ob_get_clean());
        return fclose($fileStream);
    }

    /**
     * Returns formatted current datetime
     * ---
     * @return string current date time
     */
    public static function dateNow() : string
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Creates unique ID
     * ---
     * @return string 10 characters
     */
    public static function generateUniqueID()
    {
        return bin2hex(random_bytes(5));
    }

}



