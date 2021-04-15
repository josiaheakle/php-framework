<?php 

namespace app\models;

trait DBHandler {

    public static \mysqli   $mysqli;

    protected static        $dbHost;
    protected static        $dbUser;
    protected static        $dbPass;
    protected static        $dbName;

    /**
     * Saves params to instance
     * ---
     * @param string $dbHost
     * @param string $dbName
     * @param string $dbPass
     * @param string $dbUser
     * @return void
     */
    public static function databaseInit(string $dbHost, string $dbUser, string $dbPass, string $dbName)
    {
        self::$dbHost = $dbHost;
        self::$dbUser = $dbUser;
        self::$dbPass = $dbPass;
        self::$dbName = $dbName;
        self::$mysqli = new \mysqli();
    }

    /**
     * Connects mysqli to db using params set in databaseInit
     * ---
     * @return void
     */
    public static function databaseConnect()
    {
        self::$mysqli->connect(self::$dbHost, self::$dbUser, self::$dbPass, self::$dbName);
    }

    /**
     * Returns most recent mysqli error
     * ---
     * @return string mysqli error
     */
    public static function getLastMysqliError() : string
    {
        return (self::$mysqli->error === '' ? false : self::$mysqli->error);
    }

    /**
     * Returns array of mysqli errors
     * ---
     * @return array mysqli errors
     */
    public function getMysqliErrors() : array
    {
        return self::$mysqli->error_list;
    }

}

?>