<?php

namespace app\core;

use app\migrations\m0002_add_password_column;
use PDO;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? "";
        $user = $config['user'] ?? "";
        $password = $config['password'] ?? "";
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigration()
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration){
            if($migration ==='.' || $migration === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;

            $className = pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $className();
            if(isset($instance)){
                echo "Applying migration $migration".PHP_EOL;
                $instance->up();
                echo "Applied migration $migration".PHP_EOL;
                $newMigrations[] = $migration;
            }
            }


        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else{
            echo "All migrations are applied";
        }
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;");
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    private function saveMigrations(array $migrations)
    {

        $str = implode(",",array_map(fn($m)=>"('$m')", $migrations));

       $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
                                       $str");
       $statement->execute();
    }
}