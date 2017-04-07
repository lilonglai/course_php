<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:05
 */
require "../db/PDOScheduleOperation.php";
require "../utils/DateHelp.php";

class ScheduleBusinessOperation
{
    public function get($key){
        $operator = new PDOScheduleOperation();
        $o = $operator->get($key);
        echo $o;
    }

    public function getAll(){
        $operator = new PDOScheduleOperation();
        $list = $operator->getAll();
        return $list;
    }

    private static function isCourseScheduled($secondCourse, $scheduleList){
        foreach ($scheduleList as $schedule){
            if($secondCourse->id == $schedule->courseId){
                return true;
            }
        }
        return false;
    }

    private static function isTeacherScheduled($teacherId, $scheduleList){
        foreach ($scheduleList as $schedule){
            if($teacherId == $schedule->teacherId){
                return true;
            }
        }
        return false;
    }

    private static function isTeacherInHoliday($teacherId, $onDate){
        $teacherDefaultHolidayOperation = new PDOTeacherDefaultHolidayOperation();
        $teacherHolidayOperation = new PDOTeacherHolidayOperation();
        $teacherDefaultHoliday = $teacherDefaultHolidayOperation->getByTeacherId($teacherId);
        $holidayList = $teacherHolidayOperation->getByTeacherId($teacherId);
        if(DateHelp::isHoliday($onDate, $teacherDefaultHoliday, $holidayList)){
            return true;
        }
        else{
            return false;
        }

    }

    public function getAvailableSecondCourseList($studentId, $firstCourseId){
        $scheduleOperation = new PDOScheduleOperation();
        $secondCourseOperation = new PDOSecondCourseOperation();
        $secondCourseList = $secondCourseOperation->getByFirstCourseId($firstCourseId);
        $scheduleList = $scheduleOperation->getByStudentId($studentId);
        $resultList = array();
        foreach($secondCourseList as $secondCourse){
            if(self::isCourseScheduled($secondCourse, $scheduleList)){
                continue;
            }
            $resultList[] = $secondCourse;
        }
        return $resultList;
    }

    public function getAvailableTeacherListByAbility($onDate, $onTime, $firstCourseId){
        $scheduleOperation = new PDOScheduleOperation();
        $teacherOperation = new PDOTeacherOperation();
        $teacherAbilityOperation = new PDOTeacherAbilityOperation();
        $secondCourseOperation = new PDOSecondCourseOperation();
        $scheduleList = $scheduleOperation->getByDateAndTime($onDate, $onTime);
        $teacherAbilityList = $teacherAbilityOperation->getByCourseId($firstCourseId);
        $resultList = array();
        foreach($teacherAbilityList as $teacherAbility){
            $teacherId = $teacherAbility['teacherid'];
            if(self::isTeacherInHoliday($teacherId, $onDate)){
                continue;
            }
            if(self::isTeacherScheduled($teacherId, $scheduleList)){
                continue;
            }
            $resultList[] = $teacherOperation->get($teacherId);
        }
        return $resultList;
    }

    public function getAvailableTeacherList($onDate, $onTime){
        $scheduleOperation = new PDOScheduleOperation();
        $teacherOperation = new PDOTeacherOperation();
        $scheduleList = $scheduleOperation->getByDateAndTime($onDate, $onTime);
        $teacherList = $teacherOperation->getAll();
        $resultList = array();
        foreach ($teacherList as $teacher){
            $teacherId = $teacher['id'];
            if(self::isTeacherInHoliday($teacherId, $onDate)){
                continue;
            }

            if(self::isTeacherScheduled($teacherId, $scheduleList)){
                continue;
            }

            $resultList[] = $teacher;
        }
        return $resultList;
    }

    public function getSecondCourseAndTeacherList($onDate, $onTime, $studentId, $firstCourseId){
        $secondCourseList = $this->getAvailableSecondCourseList($studentId, $firstCourseId);
        $teacherList = $this->getAvailableTeacherListByAbility($onDate, $onTime, $firstCourseId);
        $resultList = array("secondCourseList" => $secondCourseList, "teacherList" => $teacherList);
        return $resultList;
    }

    public function add($o){
        $operator = new PDOScheduleOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOScheduleOperation();
        $operator->update($o);
    }

    public function delete($key){
        $operator = new PDOScheduleOperation();
        $operator->delete($key);
    }
}