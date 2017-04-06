<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:13
 */
/*
 * begin to operate TeacherHoliday
 */
use \Slim\Http\Request;
use \Slim\Http\Response;

class ScheduleService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOScheduleOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOScheduleOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
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

    }

    static function getSecondCourseList(Request $request, Response $response){
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
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
        $result = json_encode($resultList);
        echo $result;
    }

    static function getTeacherListByGet(Request $request, Response $response){
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $firstCourseId = $request->getParam('firstCourseId');
        $scheduleOperation = new PDOScheduleOperation();
        $teacherOperation = new PDOTeacherOperation();
        $teacherAbilityOperation = new PDOTeacherAbilityOperation();
        $secondCourseOperation = new PDOSecondCourseOperation();
        $scheduleList = $scheduleOperation.getByDateAndTime(onDate, onTime);
        $teacherAbilityList = $teacherAbilityOperation->getByCourseId($firstCourseId);
        $resultList = array();
        foreach($teacherAbilityList as $teacherAbility){
            $teacherId = $teacherAbility->teacherId;
            if(self::isTeacherInHoliday($teacherId, $onTime)){
                continue;
            }
            if(self::isTeacherScheduled($teacherId, $scheduleList)){
                continue;
            }
            $resultList[] = $teacherOperation->get($teacherId);
        }
        $result = json_encode($resultList);
        echo $result;
    }

    static function getAvailableTeacherListByGet(Request $request, Response $response){
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $scheduleOperation = new PDOScheduleOperation();
        $teacherOperation = new PDOTeacherOperation();
        $scheduleList = $scheduleOperation->getByDateAndTime(onDate, onTime);
        $teacherList = $teacherOperation->getAll();
        $resultList = array();
        foreach ($teacherList as $teacher){
            $teacherId = $teacher->id;
            if(self::isTeacherInHoliday($teacherId, $onTime)){
                continue;
            }

            if(self::isTeacherScheduled($teacherId, $scheduleList)){
                continue;
            }

            $resultList[] = $teacher;
        }
        $result = json_encode($resultList);
        echo $result;
    }

    static function getSecondCourseAndTeacherListByGet(Request $request, Response $response){
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[ondate] = $request->getParam('ondate');
        $o[ontime] = $request->getParam('ontime');
        $o[studentid] = $request->getParam('studentid');
        $o[courseid] = $request->getParam('courseid');
        $o[teacherid] = $request->getParam('teacherid');
        $o[addition] = $request->getParam('addition');
        $o[description] = $request->getParam('description');

        $operator = new PDOScheduleOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[ondate] = $request->getParam('ondate');
        $o[ontime] = $request->getParam('ontime');
        $o[studentid] = $request->getParam('studentid');
        $o[courseid] = $request->getParam('courseid');
        $o[teacherid] = $request->getParam('teacherid');
        $o[addition] = $request->getParam('addition');
        $o[description] = $request->getParam('description');

        $operator = new PDOScheduleOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOScheduleOperation();
        $operator->delete($key);
    }
}