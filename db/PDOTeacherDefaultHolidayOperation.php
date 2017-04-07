<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:56
 */
require_once "PDOBaseOperation.php";

class PDOTeacherDefaultHolidayOperation extends PDOBaseOperation {
    const TABLENAME = "teacherdefaultholiday";

    public function getByTeacherId($teacherId){
        $sql = "select * from " . self::TABLENAME . " where teacherid = $teacherId";
        $list = $this->executeSql($sql);
        $result = null;
        if($list != null){
            $result = $list[0];
        }
        return $result;
    }

    public function add($teacherDefaultHoliday){
        $teacherDefaultHoliday['week1'] = $this->bool2String($teacherDefaultHoliday['week1']);
        $teacherDefaultHoliday['week2'] = $this->bool2String($teacherDefaultHoliday['week2']);
        $teacherDefaultHoliday['week3'] = $this->bool2String($teacherDefaultHoliday['week3']);
        $teacherDefaultHoliday['week4'] = $this->bool2String($teacherDefaultHoliday['week4']);
        $teacherDefaultHoliday['week5'] = $this->bool2String($teacherDefaultHoliday['week5']);
        $teacherDefaultHoliday['week6'] = $this->bool2String($teacherDefaultHoliday['week6']);
        $teacherDefaultHoliday['week7'] = $this->bool2String($teacherDefaultHoliday['week7']);

        $sql = "insert into " . self::TABLENAME . "(teacherid,week1,week2,week3,week4,week5,week6,week7) values(
        $teacherDefaultHoliday[teacherid], 
        $teacherDefaultHoliday[week1], $teacherDefaultHoliday[week2], $teacherDefaultHoliday[week3], 
        $teacherDefaultHoliday[week4], $teacherDefaultHoliday[week5], $teacherDefaultHoliday[week6], $teacherDefaultHoliday[week7])";
        $this->executeUpdateSql($sql);
        $teacherDefaultHoliday['id'] = $this->mysql_insert_id();
    }

    public function update($teacherDefaultHoliday){
        $teacherDefaultHoliday['week1'] = $this->bool2String($teacherDefaultHoliday['week1']);
        $teacherDefaultHoliday['week2'] = $this->bool2String($teacherDefaultHoliday['week2']);
        $teacherDefaultHoliday['week3'] = $this->bool2String($teacherDefaultHoliday['week3']);
        $teacherDefaultHoliday['week4'] = $this->bool2String($teacherDefaultHoliday['week4']);
        $teacherDefaultHoliday['week5'] = $this->bool2String($teacherDefaultHoliday['week5']);
        $teacherDefaultHoliday['week6'] = $this->bool2String($teacherDefaultHoliday['week6']);
        $teacherDefaultHoliday['week7'] = $this->bool2String($teacherDefaultHoliday['week7']);

        $sql = "update " . self::TABLENAME . " set teacherid=$teacherDefaultHoliday[teacherid], week1=$teacherDefaultHoliday[week1], week2=$teacherDefaultHoliday[week2], 
        week3=$teacherDefaultHoliday[week3], week4=$teacherDefaultHoliday[week4], week5=$teacherDefaultHoliday[week5], week6=$teacherDefaultHoliday[week6], week7=$teacherDefaultHoliday[week7]
        where id=$teacherDefaultHoliday[id]";
        $this->executeUpdateSql($sql);
    }

    public function deleteByTeacherId($teacherId){
        $sql = "delete from " . self::TABLENAME . " where teacherid = $teacherId";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}