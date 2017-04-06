<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:51
 */
require_once "PDOBaseOperation.php";

class PDOFirstCourseOperation extends PDOBaseOperation{
    const TABLENAME = "firstcourse";

    public function getByGrade($grade){
        $sql = "select * from ". self::TABLENAME . " where grade = $grade";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function  add($firstCourse){
        $sql = "insert into " . self::TABLENAME . "(grade,name,shortname,description) values($firstCourse[grade], '$firstCourse[name]', '$firstCourse[shortname]', '$firstCourse[description]')";
        $this->executeUpdateSql($sql);
        $firstCourse['id'] = $this->mysql_insert_id();
    }

    public function  update($firstCourse){
        $sql = "update " . self::TABLENAME . " set grade=$firstCourse[grade], name='$firstCourse[name]', shortname= '$firstCourse[shortname]', description='$firstCourse[description]' where id=$firstCourse[id]";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }

}