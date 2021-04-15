<?php

namespace app\core;

class Database {

    public static \mysqli $mysqli;

    /**
     * Creates static mysqli instance
     * ---
     * @param array  'host' : database host
     *               'user' : database username
     *               'pass' : database password
     *               'name' : database name
     */
    public function __construct(array $config)
    {
        mysqli_report(MYSQLI_REPORT_ALL);
        self::$mysqli = new \mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
    }

}