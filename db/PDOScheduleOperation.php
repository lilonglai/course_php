<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:57
 */
require "PDOBaseOperation.php";

class PDOScheduleOperation extends PDOBaseOperation {
    const TABLENAME = "schedule";
    public function getTableName(){
        return self::TABLENAME;
    }

    public function getByStudentIdOnDateAndTime($studentId, $onDate, $onTime){
        $sql = "select * from " . self::TABLENAME . " where studentid = $studentId and ondate = '$onDate' and ontime=$onTime";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByStudentId($studentId){
        $sql = "select * from " . self::TABLENAME . " where studentid = $studentId order by ondate,ontime";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByTeacherId($teacherId){
        $sql = "select * from " . self::TABLENAME . " where teacherid = $teacherId order by ondate,ontime";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByDateAndTime($onDate, $onTime){
        $sql = "select * from " . self::TABLENAME . " where ondate = $onDate ";
        if($onTime >=1){
            $sql .= "and ontime=$onTime ";
        }
        $sql .= "order by ondate,ontime";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($schedule){
        $sql = "insert into " . self::TABLENAME . "(ondate,ontime,studentid,courseid,teacherid,addition,description) 
        values('$schedule[ondate]', $schedule[ontime], $schedule[studentid], $schedule[courseid], $schedule[teacherid], 
        '$schedule[addition]', '$schedule[description]')";
        $this->executeUpdateSql($sql);
        $schedule['id'] = $this->mysql_insert_id();
    }

    public function update($schedule){
        $sql = "update ". self::TABLENAME .
            " set ondate='$schedule[ondate]', ontime=$schedule[ontime],
            studentid=$schedule[studentid], courseid=$schedule[courseid], teacherid=$schedule[teacherid],
            addition='$schedule[addition]', description='$schedule[description]'
            where id=$schedule[id]";
        $this->executeUpdateSql($sql);
    }
}
