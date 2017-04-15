<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:56
 */
require_once "PDOBaseOperation.php";

class PDOTeacherHolidayOperation extends PDOBaseOperation {
    const TABLENAME = "teacherholiday";
    public function getTableName(){
        return self::TABLENAME;
    }

    public function getByTeacherId($teacherId){
        $sql = "select * from " . self::TABLENAME . " where teacherid = :teacherId";
        $result = $this->executeSql($sql, array("teacherId" => $teacherId));
        return $result;
    }

    public function getByTeacherAndDate($teacherId, $adjustDate){
        $sql = "select * from " . self::TABLENAME . " where teacherid = :teacherId and adjustdate = :$adjustDate";
        $result = $this->executeSql($sql, array("teacherId" => $teacherId, "adjustDate" => $adjustDate));
        return $result;
    }

    public function add($teacherHoliday){
        $teacherHoliday['isholiday'] = $this->bool2String($teacherHoliday['isholiday']);
        $sql = "insert into " . self::TABLENAME . "(teacherid,adjustdate,isholiday) values(:teacherId, :adjustDate, :isHoliday)";
        $this->executeUpdateSql($sql, $teacherHoliday);
        $teacherHoliday->id = $this->mysql_insert_id();
    }

    public function update($teacherHoliday){
        $teacherHoliday['isholiday'] = $this->bool2String($teacherHoliday['isholiday']);
        $sql = "update " . self::TABLENAME . " set teacherid = :teacherId, adjustdate = :adjustDate, isholiday = isHoliday
         where id = :id";
        $this->executeUpdateSql($sql, $teacherHoliday);
    }

    public function generateObject($row)
    {
        $o = new stdClass();
        $o->id = $row['id'];
        $o->teacherId = $row['teacherid'];
        $o->adjustDate = $row['adjustdate'];
        $o->isHoliday = $row['isholiday'];
        return $o;
    }
}