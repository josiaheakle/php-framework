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
     * @param string $path 
     * @param mixed ...$args
     * @return bool true on success
     */
    public static function logDebug(string $path, ...$args) : bool
    {
        $fileStream = fopen($path, 'a');
        $dateNow = self::dateNow();
        ob_start();
        echo "\n\n[" . $dateNow . "] ========================================================================= \n";
        foreach($args as $a) {
            var_dump($a);
            echo "\n---\n";
            // echo implode(",\n", explode(",", json_encode($a, JSON_FORCE_OBJECT, 24))) . "\n";
        }
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



