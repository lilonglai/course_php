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
        $sql = "select * from ". self::TABLENAME . " where name = '$name'";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByShortName($shortName){
        $sql = "select * from ". self::TABLENAME . " where shortname = '$shortName'";
        $result = $this->executeSql($sql);
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
        $andFlag = false;
        if($teacher['name'] != null){
            $sql = $sql . " name='$teacher[name]' ";
            $andFlag=true;
        }

        if($teacher['shortname'] != null){
            $sql = $sql . ($andFlag? "and":"");
            $sql = $sql . " shortname='$teacher[shortname]' ";
            $andFlag=true;
        }

        if($teacher['phone'] != null){
            $sql = $sql . ($andFlag? "and":"");
            $sql = $sql . " phone='$teacher[phone]' ";
            $andFlag=true;
        }

        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($teacher){
        $teacher['ismaster'] = $this->bool2String($teacher['ismaster']);
        $sql = "insert into " . self::TABLENAME . "(name,shortname,phone,ismaster) values(
        '$teacher[name]', '$teacher[shortname]', '$teacher[phone]', $teacher[ismaster])";
        $this->executeUpdateSql($sql);
        $teacher['id'] = $this->mysql_insert_id();
    }

    public function update($teacher){
        $teacher['ismaster'] = $this->bool2String($teacher['ismaster']);
        $sql = "update " . self::TABLENAME . " set name='$teacher[name]', shortname='$teacher[shortname]', phone='$teacher[phone]', ismaster=$teacher[ismaster] 
        where id=$teacher[id]";
        $this->executeUpdateSql($sql);
    }

    public function retire($key){
        $sql = "update " . self::TABLENAME . " set isalive=false where id=$key";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}