<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:53
 */
require_once "PDOBaseOperation.php";

class PDOStudentOperation extends PDOBaseOperation {
    const TABLENAME = "student";
    public function getByName($name){
        $sql = "select * from ". self::TABLENAME . " where name = :name";
        $result = $this->executeSql($sql, array("name" => $name));
        return $result;
    }

    public function getByGrade($grade){
        $sql = "select * from ". self::TABLENAME . " where grade = :grade";
        $result = $this->executeSql($sql, array("grade" => $grade));
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

    public function getByTeacherId($teacherId){
        $sql = "select * from ". self::TABLENAME . " where teacherid = :teacherId";
        $result = $this->executeSql($sql, array("teacherId" => $teacherId));
        return $result;
    }

    public function add($student){
        $sql = "insert into " . self::TABLENAME . "(name,shortname,grade,testscore,targetscore,examinedate,examineplace,teacherid,description) values(
        :name, :shortName, :grade, :testScore, :targetScore, :examineDate, :examinePlace, :teacherId, :description )";
        $this->executeUpdateSql($sql, $student);
        $student['id'] = $this->mysql_insert_id();
    }

    public function update($student){
        $sql = "update " . self::TABLENAME . " set 
        name = :name, shortname = :shortName, grade = :grade, testscore = :testScore, 
        targetscore = targetScore, examinedate = :examineDate, examinePlace = :examinePlace, 
        teacherid = :teacherId, description = :description 
        where id = :id";
        $this->executeUpdateSql($sql, $student);
    }

    public function retire($key){
        $sql = "update " . self::TABLENAME . " set isalive=false where id = :key";
        $this->executeUpdateSql($sql, array("key" => $key));
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}