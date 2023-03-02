<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
abstract class DbModel extends Model {

    abstract public function fillables(): array;
    abstract public function tableName(): string;
    public function save() {
        $tableName = $this->tableName();
        $attributes = $this->fillables();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName 
                        (".implode(", ", $attributes).") 
                        VALUES 
                        (".implode(", ", $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
            if ($statement->execute()) {
                return Application::$app->db->pdo->lastInsertId();
            }
            return false;
    }
    private static function prepare($sql) {
        return Application::$app->db->pdo->prepare($sql);
    }
}