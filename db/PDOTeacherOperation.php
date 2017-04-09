<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:53
 */
require_once "PDOBaseOperation.php";

class PDOTeacherOperation extends PDOBaseOperation {
    const TABLENAME = "teacher";
    public function getByName($name){
        $sql = "select * from ". self::TABLENAME . " where name = :name";
        $result = $this->executeSql($sql, array("name" => $name));
        return $result;
    }

    public function getByShortName($shortName){
        $sql = "select * from ". self::TABLENAME . " where shortname = :shortName";
        $result = $this->executeSql($sql, array("shortName" => $shortName));
        return $result;
    }

    public function getAlive(){
        $sql = "select * from ". self::TABLENAME . " where isalive = true";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getNotAlive(){
        $sql = "select * from ". self::TABLENAME . " where isalive = false";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByCondition($teacher){
        $sql = "select * from " . self::TABLENAME . " where ";
        $binds = array();
        $andFlag = false;
        if($teacher['name'] != null){
            $sql = $sql . " name = :name ";
            $binds['name'] =$teacher['name'];
            $andFlag=true;
        }

        if($teacher['shortname'] != null){
            $sql = $sql . ($andFlag? "and":"");
            $sql = $sql . " shortname = :shortName ";
            $binds['shortName'] =$teacher['shortName'];
            $andFlag=true;
        }

        if($teacher['phone'] != null){
            $sql = $sql . ($andFlag? "and":"");
            $sql = $sql . " phone='$teacher[phone]' ";
            $binds['phone'] =$teacher['phone'];
            $andFlag=true;
        }

        $result = $this->executeSql($sql, $binds);
        return $result;
    }

    public function add($teacher){
        $teacher['ismaster'] = $this->bool2String($teacher['ismaster']);
        $sql = "insert into " . self::TABLENAME . "(name,shortname,phone,ismaster) values(:name, :shortName, :phone, :isMaster)";
        $this->executeUpdateSql($sql, $teacher);
        $teacher['id'] = $this->mysql_insert_id();
    }

    public function update($teacher){
        $teacher['isMaster'] = $this->bool2String($teacher['isMaster']);
        $sql = "update " . self::TABLENAME . " set name = :name', shortname = :shortName, phone = :phone, ismaster = :isMaster
        where id=$teacher[id]";
        $this->executeUpdateSql($sql, $teacher);
    }

    public function retire($key){
        $sql = "update " . self::TABLENAME . " set isalive=false where id = :key";
        $this->executeUpdateSql($sql, array("key" => $key));
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}