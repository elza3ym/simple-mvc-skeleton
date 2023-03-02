<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
abstract class DbModel extends Model {

    abstract public function fillables(): array;
    abstract public static function primaryKey(): string;

    abstract public static function tableName(): string;
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

    public static function findOne(array $where) {
        $statement = self::findBy($where);
        return $statement->fetchObject(static::class);
    }

    public static function findAll() {
        $tableName = static::tableName();
        $primaryKey = static::primaryKey();
        $statement = self::prepare("SELECT * FROM $tableName ORDER BY $primaryKey DESC");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
    public static function findAllBy(array $where) {
        $statement = self::findBy($where);
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function findBy(array $where) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $SQL = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $SQL");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement;
    }
}