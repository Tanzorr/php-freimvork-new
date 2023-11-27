<?php

class m0002_add_password_column
{
    public function up()
    {

        $db = \app\core\Application::$app->db;
        $stmt = $db->pdo->prepare("SELECT COUNT(*) FROM information_schema.columns WHERE table_name = 'users' AND column_name = 'password'");
        $stmt->execute();

        if ($stmt->fetchColumn() == 0) {
            $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
        }
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");
    }
}