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

    protected function executeUpdateSql($sql, $binds = null){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        if($binds != null) {
            foreach ($binds as $key => $value) {
                $key = ":" . $key;
                $stmt->bindParam($key, $value);
            }
        }
        $stmt->execute();
        if($stmt->errorInfo()){
            throw new Exception($stmt->errorInfo()[2]);
        }
    }

    protected function executeSql($sql, $binds = null){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        if($binds != null) {
            foreach ($binds as $key => $value) {
                $key = ":" . $key;
                $stmt->bindParam($key, $value);
            }
        }
        $stmt->execute();
        //$result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $rows = $stmt->fetchAll();
        $result = array();
        if($rows != null){
            foreach ($rows as $row){
                $o = $this->generateObject($row);
                $result[] = $o;
            }
        }
        return $result;
    }

    public function get($key){
        $sql = "select * from " . $this->getTableName() ." where id = :id";
        $list = $this->executeSql($sql, array("id"=> $key));
        $result = null;
        if($list != null){
            $result = $list[0];
        }
        return $result;
    }

    public function mysql_insert_id(){
        $connection = $this->getConnection();
        $id = $connection->lastInsertId();
        return $id;
    }

    public abstract function getTableName();

    public abstract function generateObject($row);

    public function bool2String($value){
        return $value ? 'true' : 'false';
    }

    public function getAll(){
        $sql = "select * from " . $this->getTableName();
        $result = $this->executeSql($sql);
        return $result;
    }

    public function delete($key){
        $sql = "delete from " . $this->getTableName() . " where id =:id";
        $this->executeUpdateSql($sql, array("id"=>$key) );
    }
}