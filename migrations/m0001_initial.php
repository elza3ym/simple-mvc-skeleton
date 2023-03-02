<?php

use app\core\Migration;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 **/
class m0001_initial implements Migration {
    public function up(): void {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB";
        $db->pdo->exec($SQL);


        // THIS IS FOR DEMO PURPOSE ONLY
        $SQL = "INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $statement = $db->pdo->prepare($SQL);
        $statement->bindValue(':firstname', 'John');
        $statement->bindValue(':lastname', 'Doe');
        $statement->bindValue(':email', 'test@test.com');
        $statement->bindValue(':password', password_hash('test1234', PASSWORD_DEFAULT));
        $statement->execute();
    }

    public function down(): void {
        $db = \app\core\Application::$app->db;
        $SQL ="DROP TABLE users";
        $db->pdo->exec($SQL);
    }
}