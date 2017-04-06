<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:47
 */
abstract class PDOBaseOperation{
    const USERNAME="root";
    const PASSWORD="Bxy19890723";
    const HOST="localhost";
    const DB="course";

    private static $connection;

    private function getConnection()
    {
        if (self::$connection == null) {
            $username = self::USERNAME;
            $password = self::PASSWORD;
            $host = self::HOST;
            $db = self::DB;
            self::$connection  = new PDO("mysql:dbname=$db;host=$host", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        return self::$connection ;
    }

    protected function executeUpdateSql($sql){
        $connection = $this->getConnection();
        $stmt = $connection->exec($sql);
    }

    protected function executeSql($sql){
        $connection = $this->getConnection();
        $stmt = $connection->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function get($key){
        $sql = "select * from " . $this->getTableName() ." where id = $key";
        $list = $this->executeSql($sql);
        $result = null;
        if($list != null){
            $result = $list[0];
        }
        return $result;
    }

    public function mysql_insert_id(){
        $sql = "select last_insert_id()";
        $list = $this->executeSql($sql);
        return $list[0][0];
    }

    public abstract function getTableName();

    public function bool2String($value){
        return $value ? 'true' : 'false';
    }

    public function getAll(){
        $sql = "select * from " . $this->getTableName();
        $result = $this->executeSql($sql);
        return $result;
    }

    public function delete($key){
        $sql = "delete from " . $this->getTableName() . " where id =:$key";
        $this->executeUpdateSql($sql);
    }
}