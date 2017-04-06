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
        $sql = "select * from " . self::TABLENAME . " where teacherid = $teacherId";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByTeacherAndDate($teacherId, $adjustDate){
        $sql = "select * from " . self::TABLENAME . " where teacherid = $teacherId and adjustdate='$adjustDate'";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($teacherHoliday){
        $teacherHoliday['isholiday'] = $this->bool2String($teacherHoliday['isholiday']);
        $sql = "insert into " . self::TABLENAME . "(teacherid,adjustdate,isholiday) values(" .
            "$teacherHoliday[teacherid], '$teacherHoliday[adjustdate]', $teacherHoliday[isholiday])";
        $this->executeUpdateSql($sql);
        $teacherHoliday['id'] = $this->mysql_insert_id();
    }

    public function update($teacherHoliday){
        $teacherHoliday['isholiday'] = $this->bool2String($teacherHoliday['isholiday']);
        $sql = "update " . self::TABLENAME . " set teacherid=$teacherHoliday[teacherid], adjustdate='$teacherHoliday[adjustdate]', isholiday=$teacherHoliday[isholiday] " .
            "where id = $teacherHoliday[id]";
        $this->executeUpdateSql($sql);
    }
}