<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:52
 */
require_once "PDOBaseOperation.php";

class PDOSecondCourseOperation extends PDOBaseOperation {
    const TABLENAME = "secondcourse" ;
    public function getByFirstCourseId($firstCourseId){
        $sql = "select * from ". self::TABLENAME . " where firstcourseid = :firstCourseId";
        $result = $this->executeSql($sql, array("firstCourseId" => $firstCourseId));
        return $result;
    }

    public function getByGrade($grade){
        $sql = "select secondcourse.* from " . PDOFirstCourseOperation::TABLENAME . " firstcourse , " . self::TABLENAME . " secondcourse 
        where firstcourse.id=secondcourse.firstcourseid and grade = :grade order by secondcourse.firstcourseid";
        $result = $this->executeSql($sql, array("grade" => $grade));
        return $result;
    }

    public function  add($secondCourse){
        $sql = "insert into " . self::TABLENAME . "(name, shortname, firstcourseid, description) values( :name, :shortName, :firstCourseId, :description)";
        $this->executeUpdateSql($sql, $secondCourse);
        $secondCourse['id'] = $this->mysql_insert_id();
    }

    public function  update($secondCourse){
        $sql = "update " . self::TABLENAME . " set name = :name, shortname = :shortName, firstcourseid = :firstCourseId, description = :description where id = :id";
        $this->executeUpdateSql($sql, $secondCourse);
    }

    public function getTableName(){
        return self::TABLENAME;
    }

    public function generateObject($row)
    {
        $o = new stdClass();
        $o->id = $row['id'];
        $o->name = $row['name'];
        $o->shortName = $row['shortname'];
        $o->firstCourseId = $row['firstcourseid'];
        $o->description = $row['description'];
        return $o;
    }
}