<?php 

namespace app\models;

trait DBHandler {

    public \mysqli $mysqli;

    public string $dbHost;
    public string $dbUser;
    public string $dbPass;
    public string $dbName;

    public function databaseInit(string $dbHost, string $dbName, string $dbPass, string $dbUser)
    {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
    }

    public function databaseConnect()
    {
        mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName, $this->mysqli);
    }

    /**
     * Returns most recent mysqli error
     * ---
     * @return string mysqli error
     */
    public function geLastMysqliError() : string
    {
        return $this->mysqli->error;
    }

    /**
     * Returns array of mysqli errors
     * ---
     * @return array mysqli errors
     */
    public function getMysqliErrors() : array
    {
        return $this->mysqli->error_list;
    }

}

?>