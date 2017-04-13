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
        $sql = "select * from ". self::TABLENAME . " where grade = :grade";
        $result = $this->executeSql($sql, array("grade" => $grade));
        return $result;
    }

    public function  add($firstCourse){
        $sql = "insert into " . self::TABLENAME . "(grade,name,shortname,description) values(:grade, :name, :shortName, :description)";
        $this->executeUpdateSql($sql, $firstCourse);
        $firstCourse['id'] = $this->mysql_insert_id();
    }

    public function  update($firstCourse){
        $sql = "update " . self::TABLENAME . " set grade= :grade, name= :name, shortname= :shortName, description= :description
         where id= :id";
        $this->executeUpdateSql($sql, $firstCourse);
    }

    public function getTableName(){
        return self::TABLENAME;
    }

    public function generateObject($row)
    {
        $o = new stdClass();
        $o->id = $row['id'];
        $o->grade = $row['grade'];
        $o->name = $row['name'];
        $o->shortName = $row['shortname'];
        $o->description = $row['description'];
        return $o;
    }

}