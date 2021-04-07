<?php

namespace app\core;

/**
 * Class Response
 * ---
 * @author Josiah Eakle <dev@josiaheakle.com>
 * @package app/core
 */
class Response 
{

    public function setStatusCode(int $code )
    {
        http_response_code($code);
    }

}