<?php

namespace app\core;

use app\utils\Util;
use Exception;

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
        mysqli_report(MYSQLI_REPORT_ERROR);
        self::$mysqli = new \mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
    }

    /**
     * For all the files in the migrations folder, 
     * if they have not yet been applied, apply the migration. 
     * The applied migrations are added to the database.
     */
    public static function applyMigrations() : void
    {
        self::createMigrationTable();
        $appliedMigrations = self::getAppliedMigrations() ?? [];

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR . '/migrations');
        foreach($files as $file) {
            if($file[0] === 'm') {
                $migrationName = pathinfo($file, PATHINFO_FILENAME);
                if(!in_array($migrationName, $appliedMigrations)) {
                    Util::logDebug('Applying migration {' . $migrationName . '}');
                    self::applyMigration($migrationName);
                    array_push($newMigrations, $migrationName);
                } else {
                    Util::logDebug('Migration {' . $migrationName . '} already applied.');

                }
            }
        }
        self::updateDatabaseMigrations($newMigrations);
        
    }

    /**
     * Requires and calls migration from migrations folder
     */
    private static function applyMigration(string $migrationName) : void
    {
        require_once(Application::$ROOT_DIR . "/migrations/" . $migrationName . ".php");
        $migration = new $migrationName;
        $migration->up();
    }

    /**
     * Adds newly applied migrations to database
     */
    private static function updateDatabaseMigrations(array $migrations)  : void
    {
        if(!empty($migrations)) {
            $sql  = "INSERT INTO migrations (migration) VALUES (?)" . str_repeat(', (?)', count($migrations) -1 );
            $stmt = self::$mysqli->prepare($sql);
            $stmt->bind_param(str_repeat('s', count($migrations)), ...$migrations);
            $stmt->execute();
        }
    }

    /**
     * Creates migration table in db to keep track of applied migrations
     */
    public static function createMigrationTable() : void
    {
        $sql    = "CREATE TABLE IF NOT EXISTS migrations( "
                . "id INT AUTO_INCREMENT PRIMARY KEY, "
                . "migration VARCHAR(255), "
                . "created DATETIME DEFAULT CURRENT_TIMESTAMP )";
        $stmt   = self::$mysqli->prepare($sql);
        $stmt->execute();
    }

    /**
     * Gets all migrations from migrations table
     * ---
     * @return array of strings with migration names
     */
    public static function getAppliedMigrations() : array
    {
        $migrations = [];
        $sql  = "SELECT migration FROM migrations";
        $stmt = self::$mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all();
        foreach($result as $res) {
           array_push($migrations, $res[0]); 
        }
        return $migrations;
    }

}