<?php

namespace app\core;

use app\core\QueryBuilder;


abstract class DbModel extends Model
{
    public abstract static function tableName(): string;

    public abstract function attributes(): array;

    public abstract function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
                    VALUES(".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        //var_dump($statement);
        //die();

        $statement->execute();
        //echo "hehe";
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
       # $attributes = array_keys($where);
       # $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
       # $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
       # foreach ($where as $key => $item) {
       #     $statement->bindValue(":$key", $item);
       # }

       # $statement->execute();
       # return $statement->fetchObject(static::class);
        $query = new QueryBuilder($tableName, static::class);
        return $query->where($where);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}

?>
