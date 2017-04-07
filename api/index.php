<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/20
 * Time: 11:56
 */


require "../vendor/autoload.php";

require "FirstCourseService.php";
require "SecondCourseService.php";
require "StudentService.php";
require "TeacherService.php";
require "TeacherAbilityService.php";
require "TeacherHolidayService.php";
require "TeacherDefaultHolidayService.php";
require "ScheduleService.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    return $response->write("Hello, " . $args['name']);
});

$app->get('/firstcourse/get', 'FirstCourseService::get');
$app->get('/firstcourse/getAll', 'FirstCourseService::getAll');
$app->get('/firstcourse/add', 'FirstCourseService::add');
$app->get('/firstcourse/update', 'FirstCourseService::update');
$app->get('/firstcourse/delete', 'FirstCourseService::delete');

$app->get('/secondcourse/get', 'SecondCourseService::get');
$app->get('/secondcourse/getAll', 'SecondCourseService::getAll');
$app->get('/secondcourse/add', 'SecondCourseService::add');
$app->get('/secondcourse/update', 'SecondCourseService::update');
$app->get('/secondcourse/delete', 'SecondCourseService::delete');

$app->get('/student/get', 'StudentService::get');
$app->get('/student/getAll', 'StudentService::getAll');
$app->get('/student/getAlive', 'StudentService::getAlive');
$app->get('/student/getNotAlive', 'StudentService::getNotAlive');
$app->get('/student/add', 'StudentService::add');
$app->get('/student/update', 'StudentService::update');
$app->get('/student/retire', 'StudentService::retire');
$app->get('/student/delete', 'StudentService::delete');

$app->get('/teacher/get', 'TeacherService::get');
$app->get('/teacher/getAll', 'TeacherService::getAll');
$app->get('/teacher/getAlive', 'TeacherService::getAlive');
$app->get('/teacher/getNotAlive', 'TeacherService::getNotAlive');
$app->get('/teacher/add', 'TeacherService::add');
$app->get('/teacher/update', 'TeacherService::update');
$app->get('/teacher/retire', 'TeacherService::retire');
$app->get('/teacher/delete', 'TeacherService::delete');

$app->get('/teacherability/get', 'TeacherAbilityService::get');
$app->get('/teacherability/getAll', 'TeacherAbilityService::getAll');
$app->get('/teacherability/add', 'TeacherAbilityService::add');
$app->get('/teacherability/update', 'TeacherAbilityService::update');
$app->get('/teacherability/delete', 'TeacherAbilityService::delete');

$app->get('/teacherholiday/get', 'TeacherHolidayService::get');
$app->get('/teacherholiday/getAll', 'TeacherHolidayService::getAll');
$app->get('/teacherholiday/add', 'TeacherHolidayService::add');
$app->get('/teacherholiday/update', 'TeacherHolidayService::update');
$app->get('/teacherholiday/delete', 'TeacherHolidayService::delete');

$app->get('/teacherdefaultholiday/get', 'TeacherDefaultHolidayService::get');
$app->get('/teacherdefaultholiday/getAll', 'TeacherDefaultHolidayService::getAll');
$app->get('/teacherdefaultholiday/add', 'TeacherDefaultHolidayService::add');
$app->get('/teacherdefaultholiday/update', 'TeacherDefaultHolidayService::update');
$app->get('/teacherdefaultholiday/delete', 'TeacherDefaultHolidayService::delete');

$app->get('/schedule/get', 'ScheduleService::get');
$app->get('/schedule/getAll', 'ScheduleService::getAll');
$app->get('/schedule/getAvailableSecondCourseList', 'ScheduleService::getAvailableSecondCourseList');
$app->get('/schedule/getAvailableTeacherListByAbility', 'ScheduleService::getAvailableTeacherListByAbility');
$app->get('/schedule/getAvailableTeacherList', 'ScheduleService::getAvailableTeacherList');
$app->get('/schedule/getSecondCourseAndTeacherList', 'ScheduleService::getSecondCourseAndTeacherList');
$app->get('/schedule/add', 'ScheduleService::add');
$app->get('/schedule/update', 'ScheduleService::update');
$app->get('/schedule/delete', 'ScheduleService::delete');

$app->run();

