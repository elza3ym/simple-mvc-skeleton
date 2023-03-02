<?php

use app\core\Migration;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 **/
class m002_create_blogsTable implements Migration {
    public function up(): void {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE blogs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                image TEXT NOT NULL,
                userId INT DEFAULT 0 NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB";
        $db->pdo->exec($SQL);
    }

    public function down(): void {
        $db = \app\core\Application::$app->db;
        $SQL ="DROP TABLE blogs";
        $db->pdo->exec($SQL);
    }
}