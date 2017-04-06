<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:52
 */
require "PDOBaseOperation.php";

class PDOSecondCourseOperation extends PDOBaseOperation {
    const TABLENAME = "secondcourse" ;
    public function getByFirstCourseId($firstCourseId){
        $sql = "select * from ". self::TABLENAME . " where firstcourseid = $firstCourseId";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByGrade($grade){
        $sql = "select secondcourse.* from " . PDOFirstCourseOperation::TABLENAME . " firstcourse , " . self::TABLENAME . " secondcourse where firstcourse.id=secondcourse.firstcourseid and grade = $grade " .
            "order by secondcourse.firstcourseid";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function  add($secondCourse){
        $sql = "insert into " . self::TABLENAME . "(name,shortname,firstcourseid,description) values('$secondCourse[name]', '$secondCourse[shortname]', $secondCourse[firstcourseid], '$secondCourse[description]')";
        $this->executeUpdateSql($sql);
        $secondCourse['id'] = $this->mysql_insert_id();
    }

    public function  update($secondCourse){
        $sql = "update " . self::TABLENAME . " set name='$secondCourse[name]', shortname= '$secondCourse[shortname]', firstcourseid=$secondCourse[firstcourseid], description='$secondCourse[description]' where id=$secondCourse[id]";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}