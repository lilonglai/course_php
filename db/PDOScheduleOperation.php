<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:57
 */
require_once "PDOBaseOperation.php";

class PDOScheduleOperation extends PDOBaseOperation {
    const TABLENAME = "schedule";

    public function getByStudentIdOnDateAndTime($studentId, $onDate, $onTime){
        $sql = "select * from " . self::TABLENAME . " where studentid = :studentId and ondate = :onDate and ontime= :onTime";
        $result = $this->executeSql($sql, array("studentId" => $studentId, "ondate" => $onDate, "ontime" => $onTime));
        return $result;
    }

    public function getByStudentId($studentId){
        $sql = "select * from " . self::TABLENAME . " where studentid = :studentId order by ondate,ontime";
        $result = $this->executeSql($sql, array("studentId" => $studentId));
        return $result;
    }

    public function getByTeacherId($teacherId){
        $sql = "select * from " . self::TABLENAME . " where teacherid = :teacherId order by ondate,ontime";
        $result = $this->executeSql($sql, array("teacherId" => $teacherId));
        return $result;
    }

    public function getByDateAndTime($onDate, $onTime){
        $sql = "select * from " . self::TABLENAME . " where ondate = :onDate ";
        $binds = array("onDate" => $onDate);
        if($onTime >=1){
            $sql .= "and ontime = :onTime ";
            $binds['ontime'] = $onTime;
        }
        $sql .= "order by ondate,ontime";
        $result = $this->executeSql($sql, $binds);
        return $result;
    }

    public function add($schedule){
        $sql = "insert into " . self::TABLENAME . "(ondate,ontime,studentid,courseid,teacherid,addition,description) 
        values(:onDate, :onTime, :studentId, :courseId, :teacherId, :addition, :description)";
        $this->executeUpdateSql($sql, $schedule);
        $schedule['id'] = $this->mysql_insert_id();
    }

    public function update($schedule){
        $sql = "update ". self::TABLENAME .
            " set ondate = :onDate, ontime = :onTime,
            studentid = :studentId, courseid = :courseId, teacherid = :teacherId,
            addition = :addition, description = :description
            where id = :id";
        $this->executeUpdateSql($sql, $schedule);
    }

    public function getTableName(){
        return self::TABLENAME;
    }

    public function generateObject($row)
    {
        $o = new stdClass();
        $o->id = $row['id'];
        $o->onDate = $row['ondate'];
        $o->onTime = $row['ontime'];
        $o->studentId = $row['studentid'];
        $o->courseId = $row['courseid'];
        $o->teacherId = $row['teacherid'];
        $o->addition = $row['addition'];
        $o->description = $row['description'];
        return $o;
    }
}
