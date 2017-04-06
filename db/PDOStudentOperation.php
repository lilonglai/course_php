<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:53
 */
require "PDOBaseOperation.php";

class PDOStudentOperation extends PDOBaseOperation {
    const TABLENAME = "student";
    public function getByName($name){
        $sql = "select * from ". self::TABLENAME . " where name = '$name'";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByGrade($grade){
        $sql = "select * from ". self::TABLENAME . " where grade = $grade";
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

    public function getByTeacherId($teacherId){
        $sql = "select * from ". self::TABLENAME . " where teacherid = $teacherId";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($student){
        $sql = "insert into " . self::TABLENAME . "(name,shortname,grade,testscore,targetscore,examinedate,examineplace,teacherid,description) values(
        '$student[name]', '$student[shortname]', $student[grade], '$student[testscore]', '$student[targetscore]', '$student[examinedate]', '$student[examineplace]', $student[teacherid], '$student[description]' )";
        $this->executeUpdateSql($sql);
        $student['id'] = $this->mysql_insert_id();
    }

    public function update($student){
        $sql = "update " . self::TABLENAME . " set 
        name='$student[name]', shortname= '$student[shortname]', grade=$student[grade], testscore='$student[testscore]', 
        targetscore='$student[targetscore]', examinedate='$student[examinedate]', examineplace='$student[examineplace]', teacherid=$student[teacherid], description='$student[description]' 
        where id=$student[id]";
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