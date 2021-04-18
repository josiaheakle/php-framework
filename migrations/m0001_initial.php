<?php

use app\core\Database;
use app\utils\Util;

class m0001_initial {
    public function up()
    {
        $sql    = "CREATE TABLE users ( "
                . "id INT AUTO_INCREMENT PRIMARY KEY, "
                . "unique_id VARCHAR(255) NOT NULL, "
                . "firstName VARCHAR(255) NOT NULL, "
                . "lastName  VARCHAR(255) NOT NULL, "
                . "email     VARCHAR(255) NOT NULL UNIQUE, "
                . "password  VARCHAR(255) NOT NULL, "
                . "created   DATETIME DEFAULT CURRENT_TIMESTAMP )";
        $stmt   = Database::$mysqli->prepare($sql);
        $stmt->execute();
        Util::logDebug('m0001 applied');
    }
    public function down()
    {
        $sql    = "DROP TABLE users";
        $stmt   = Database::$mysqli->prepare($sql);
        $stmt->execute();
    }
}