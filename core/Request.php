<?php

namespace app\core;

/**
 * Class Request
 * ---
 * @author Josiah Eakle
 * @package app\core
 */
class Request 
{

    /**
     * Gets current path from uri
     * ---
     * @return string
     */
    public function getPath() : string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $q_pos = \strpos($path, '?');
        if($q_pos !== false) {
            $path = \substr($path, 0, $q_pos);
        }
        return $path;
    }

    /**
     * Gets current request method
     * ---
     * @return string : "get", "post"
     */
    public function getMethod() : string
    {
        return \strtolower($_SERVER['REQUEST_METHOD']);
    }

}

?>