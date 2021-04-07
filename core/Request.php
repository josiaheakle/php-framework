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
    public function method() : string
    {
        return \strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Returns true if request is get type
     */
    public function isGet()
    {
        return $this->method() === 'get';
    }

    /**
     * Returns true if request is post type
     */
    public function isPost()
    {
        return $this->method() === 'post';
    }    

    /**
     * Returns data from get/post request
     * ---
     * @return array 
     */
    public function getBody() : array
    {
        $body = [];
        if($this->method() === 'get') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        } else if ($this->method() === 'post') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

}

?>