<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
class Database {
    public \PDO $pdo;

    public function __construct(array $config) {
        $this->pdo = new \PDO($config['dsn'], $config['user'], $config['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $dbname = "`".str_replace("`","``",$config['dbname'])."`";
        $this->pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $this->pdo->query("use $dbname");
    }

    public function applyMigrations() {
        $savedMigrations = [];
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $migrationFiles = scandir(Application::$ROOT_DIR."/migrations");
        $migrationsToApply = array_diff($migrationFiles, $appliedMigrations);
        foreach ($migrationsToApply as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR."/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("⚙️ Applying Migration : ".$migration);
            $instance->up();
            $this->log("✔️ Applied Migration : ".$migration);
            $savedMigrations[] = $migration;
        }

        if (empty($savedMigrations)) {
            $this->log("All Migration are migrated!");
        } else {
            $this->saveMigrations($savedMigrations);
        }
    }

    public function createMigrationsTable() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        migration VARCHAR(255) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB");
    }

    public function getAppliedMigrations() {
        $statement = $this->pdo->prepare("SELECT migration from migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function log($message) {
        echo "[".date('Y-m-d H:i:s')."] - ".$message.PHP_EOL;
    }

    private function saveMigrations(array $savedMigrations) {
        $migrationStr = implode(",", array_map(fn($m) => "('$m')", $savedMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migrationStr");
        $statement->execute();
    }
}