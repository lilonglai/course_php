<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:54
 */
require "PDOBaseOperation.php";

class PDOTeacherAbilityOperation extends PDOBaseOperation {
    const TABLENAME = "teacherability";
    public function getAll(){
        $sql = "select teacherability.* from " . PDOFirstCourseOperation::TABLENAME ." firstcourse, " . self::TABLENAME . " teacherability"
            . " where firstcourse.id=teacherability.courseid"
            . " order by firstcourse.grade";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByTeacherId($teacherId){
        $sql = "select teacherability.* from " . PDOFirstCourseOperation::TABLENAME ." firstcourse, " . self::TABLENAME . " teacherability"
            . " where firstcourse.id=teacherability.courseid and teacherability.teacherid = $teacherId"
            . " order by firstcourse.grade";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByCourseId($courseId){
        $sql = "select teacherability.* from " . PDOFirstCourseOperation::TABLENAME ." firstcourse, " . self::TABLENAME . " teacherability"
            . " where firstcourse.id=teacherability.courseid and teacherability.courseid = $courseId"
            . " order by firstcourse.grade";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($teacherAbility){
        $sql = "insert into " . self::TABLENAME . "(teacherid,courseid) values(
        $teacherAbility[teacherid], $teacherAbility[courseid])";
        $this->executeUpdateSql($sql);
        $teacherAbility['id'] = $this->mysql_insert_id();
    }

    public function update($teacherAbility){
        $sql = "update " . self::TABLENAME . " set teacherid=$teacherAbility[teacherid], courseid=$teacherAbility[courseid]
        where id=$teacherAbility[id]";
        $this->executeUpdateSql($sql);
    }

    public function deleteByTeacherId($teacherId){
        $sql = "delete from " . self::TABLENAME . " where teacherid = $teacherId";
        $this->executeUpdateSql($sql);
    }

    public function deleteByTeacherAndGrade($teacherId,$grade){
        $sql = "delete t from " .  self::TABLENAME . " t where t.teacherid = $teacherId and t.courseid in(select c.id from " . PDOFirstCourseOperation::TABLENAME . " c where c.grade = $grade)";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}