<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 14:54
 */
require_once "PDOBaseOperation.php";

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
            . " where firstcourse.id=teacherability.courseid and teacherability.teacherid = :teacherId"
            . " order by firstcourse.grade";
        $result = $this->executeSql($sql, array("teacherId" => $teacherId));
        return $result;
    }

    public function getByCourseId($courseId){
        $sql = "select teacherability.* from " . PDOFirstCourseOperation::TABLENAME ." firstcourse, " . self::TABLENAME . " teacherability 
        where firstcourse.id=teacherability.courseid and teacherability.courseid = :courseId order by firstcourse.grade";
        $result = $this->executeSql($sql, array("courseId" => $courseId));
        return $result;
    }

    public function add($teacherAbility){
        $sql = "insert into " . self::TABLENAME . "(teacherid,courseid) values(:teacherId, :courseId)";
        $this->executeUpdateSql($sql, $teacherAbility);
        $teacherAbility['id'] = $this->mysql_insert_id();
    }

    public function update($teacherAbility){
        $sql = "update " . self::TABLENAME . " set teacherid = :teacherId, courseid = :courseId
        where id = :id";
        $this->executeUpdateSql($sql, $teacherAbility);
    }

    public function deleteByTeacherId($teacherId){
        $sql = "delete from " . self::TABLENAME . " where teacherid = :teacherId";
        $this->executeUpdateSql($sql, array("teacherId" => $teacherId));
    }

    public function deleteByTeacherAndGrade($teacherId, $grade){
        $sql = "delete t from " .  self::TABLENAME . " t where t.teacherid = :teacherId and t.courseid in(select c.id from " . PDOFirstCourseOperation::TABLENAME . " c where c.grade = :grade)";
        $this->executeUpdateSql($sql, array("teacherId" => $teacherId, "grade" => $grade));
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}