<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/21
 * Time: 21:14
 */

abstract class PDOBaseOperation{
    const USERNAME="root";
    const PASSWORD="";
    const HOST="localhost";
    const DB="course";

    private function getConnection(){
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $host = self::HOST;
        $db = self::DB;
        $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        return $connection;
    }

    protected function executeUpdateSql($sql){
        $connection = $this->getConnection();
        $stmt = $connection->exec($sql);
    }

    protected function executeSql($sql){
        $connection = $this->getConnection();
        $stmt = $connection->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function get($key){
        $sql = "select * from " . $this->getTableName() ." where id = $key";
        $list = $this->executeSql($sql);
        $result = null;
        if($list != null){
            $result = $list[0];
        }
        return $result;
    }

    public abstract function getTableName();

    public function bool2String($value){
        return $value ? 'true' : 'false';
    }

    public function getAll(){
        $sql = "select * from " . $this->getTableName();
        $result = $this->executeSql($sql);
        return $result;
    }

    public function delete($key){
        $sql = "delete from " . $this->getTableName() . " where id =:$key";
        $this->executeUpdateSql($sql);
    }
}

class PDOFirstCourseOperation extends PDOBaseOperation{
    const TABLENAME = "firstcourse";

    public function getByGrade($grade){
        $sql = "select * from ". self::TABLENAME . " where grade = $grade";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function  add($firstCourse){
        $sql = "insert into " . self::TABLENAME . "(grade,name,shortname,description) values($firstCourse[grade], '$firstCourse[name]', '$firstCourse[shortname]', '$firstCourse[description]')";
        $this->executeUpdateSql($sql);
    }

    public function  update($firstCourse){
        $sql = "update " . self::TABLENAME . " set grade=$firstCourse[grade], name='$firstCourse[name]', shortname= '$firstCourse[shortname]', description='$firstCourse[description]' where id=$firstCourse[id]";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }

}

/*
$test = new PDOFirstCourseOperation();
$test->getByGrade(1);
$firstCourse = array();
$firstCourse['grade'] =1;
$firstCourse['name']="good";
$firstCourse['shortname']="g";
$firstCourse['description']="good is for test";
//$test->add($firstCourse);

$firstCourse['id'] = '70';
$firstCourse['description']="good is for test2";
$test->update($firstCourse);
*/

class PDOSecondCourseOperation extends PDOBaseOperation {
    const TABLENAME = "secondcourse" ;
    public function getByFirstCourseId($firstCourseId){
        $sql = "select * from ". self::TABLENAME . " where firstcourseid = $firstCourseId";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByGrade($grade){
        $sql = "select secondcourse.* from " . PDOFirstCourseOperation::TABLENAME . " firstcourse , " . self::TABLENAME . " secondcourse where firstcourse.id=secondcourse.firstcourseid and grade = $grade " .
            "order by secondcourse.firstcourseid";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function  add($secondCourse){
        $sql = "insert into " . self::TABLENAME . "(name,shortname,firstcourseid,description) values('$secondCourse[name]', '$secondCourse[shortname]', $secondCourse[firstcourseid], '$secondCourse[description]')";
        $this->executeUpdateSql($sql);
    }

    public function  update($secondCourse){
        $sql = "update " . self::TABLENAME . " set name='$secondCourse[name]', shortname= '$secondCourse[shortname]', firstcourseid=$secondCourse[firstcourseid], description='$secondCourse[description]' where id=$secondCourse[id]";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}

/*
$test = new PDOSecondCourseOperation();
$test->getByGrade(1);

$secondCourse = array();
$secondCourse['name']="good";
$secondCourse['shortname']="g";
$secondCourse['firstcourseid']=1;
$secondCourse['description']="good is for test";
//$test->add($firstCourse);

$secondCourse['id'] = '211';
$secondCourse['description']="good is for test2";
$test->update($secondCourse);

*/

class PDOStudentOperation extends PDOBaseOperation {
    const TABLENAME = "student";
    public function getByName($name){
        $sql = "select * from ". self::TABLENAME . " where name = '$name'";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByGrade($grade){
        $sql = "select * from ". self::TABLENAME . " where grade = $grade";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getAlive(){
        $sql = "select * from ". self::TABLENAME . " where isalive = true";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getNotAlive(){
        $sql = "select * from ". self::TABLENAME . " where isalive = false";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByTeacherId($teacherId){
        $sql = "select * from ". self::TABLENAME . " where teacherid = $teacherId";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($student){
        $sql = "insert into " . self::TABLENAME . "(name,shortname,grade,testscore,targetscore,examinedate,examineplace,teacherid,description) values(
        '$student[name]', '$student[shortname]', $student[grade], '$student[testscore]', '$student[targetscore]', '$student[examinedate]', '$student[examineplace]', $student[teacherid], '$student[description]' )";
        $this->executeUpdateSql($sql);
    }

    public function update($student){
        $sql = "update " . self::TABLENAME . " set 
        name='$student[name]', shortname= '$student[shortname]', grade=$student[grade], testscore='$student[testscore]', 
        targetscore='$student[targetscore]', examinedate='$student[examinedate]', examineplace='$student[examineplace]', teacherid=$student[teacherid], description='$student[description]' 
        where id=$student[id]";
        $this->executeUpdateSql($sql);
    }

    public function retire($key){
        $sql = "update " . self::TABLENAME . " set isalive=false where id=$key";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}

/*
$test = new PDOStudentOperation();
$test->getAlive();
$test->getNotAlive();

$test->getByGrade(1);

$test->getByTeacherId(5);

$test->getByName("陈思汝");

$student = array();
$student['name'] = 'test';
$student['shortname'] = 'test';
$student['grade'] = 1;
$student['testscore'] = "50";
$student['targetscore'] = "59";
$student['teacherid'] = 1;
$student['examinedate'] = "1985-06-20";
$student['examineplace'] = "SH";
$student['description'] = "this is the test";
//$test->add($student);

$student['description'] = "this is the test4";
$student['id'] = 94;
$test->update($student);
*/

class PDOTeacherOperation extends PDOBaseOperation {
    const TABLENAME = "teacher";
    public function getByName($name){
        $sql = "select * from ". self::TABLENAME . " where name = '$name'";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByShortName($shortName){
        $sql = "select * from ". self::TABLENAME . " where shortname = '$shortName'";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getAlive(){
        $sql = "select * from ". self::TABLENAME . " where isalive = true";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getNotAlive(){
        $sql = "select * from ". self::TABLENAME . " where isalive = false";
        $result = $this->executeSql($sql);
        return $result;
    }

    public function getByCondition($teacher){
        $sql = "select * from " . self::TABLENAME . " where ";
        $andFlag = false;
        if($teacher['name'] != null){
            $sql = $sql . " name='$teacher[name]' ";
            $andFlag=true;
        }

        if($teacher['shortname'] != null){
            $sql = $sql . ($andFlag? "and":"");
            $sql = $sql . " shortname='$teacher[shortname]' ";
            $andFlag=true;
        }

        if($teacher['phone'] != null){
            $sql = $sql . ($andFlag? "and":"");
            $sql = $sql . " phone='$teacher[phone]' ";
            $andFlag=true;
        }

        $result = $this->executeSql($sql);
        return $result;
    }

    public function add($teacher){
        $teacher['ismaster'] = $this->bool2String($teacher['ismaster']);
        $sql = "insert into " . self::TABLENAME . "(name,shortname,phone,ismaster) values(
        '$teacher[name]', '$teacher[shortname]', '$teacher[phone]', $teacher[ismaster])";
        $this->executeUpdateSql($sql);
    }

    public function update($teacher){
        $teacher['ismaster'] = $this->bool2String($teacher['ismaster']);
        $sql = "update " . self::TABLENAME . " set name='$teacher[name]', shortname='$teacher[shortname]', phone='$teacher[phone]', ismaster=$teacher[ismaster] 
        where id=$teacher[id]";
        $this->executeUpdateSql($sql);
    }

    public function retire($key){
        $sql = "update " . self::TABLENAME . " set isalive=false where id=$key";
        $this->executeUpdateSql($sql);
    }

    public function getTableName(){
        return self::TABLENAME;
    }
}

/*
$test = new PDOTeacherOperation();
$test->get(1);

$test->getByName("test");

$test->getByShortName("test");

$test->getAll();

$test->getAlive();

$test->getNotAlive();

$teacher = array();
$teacher['name'] = 'test';
$test->getByCondition($teacher);

$teacher['name'] = "test";
$teacher['shortname'] = "test";
$teacher['ismaster'] = true;
$teacher['phone'] = "15221002264";
//$test->add($teacher);
$teacher['id'] = 37;
$teacher['ismaster'] = 'false';
$test->update($teacher);
*/

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

/*
$test = new PDOTeacherAbilityOperation();
$test->get(1);

$test->getAll(1);

$test->getByTeacherId(1);

$test->getByCourseId(1);

$test->deleteByTeacherId(1);

$test->deleteByTeacherAndGrade(1,1);

$teacherAbility = array();
$teacherAbility['teacherid'] = 25;
$teacherAbility['courseid'] = 25;
$test->add($teacherAbility);
*/

class PDOTeacherDefaultHolidayOperation extends PDOBaseOperation {
    const TABLENAME = "teacherdefaultholiday";

    public function getByTeacherId($teacherId){
        $sql = "select * from " . self::TABLENAME . " where teacherid = $teacherId";
        $result = $this->executeSql($sql);
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

/*
$test = new PDOTeacherDefaultHolidayOperation();
$test->get(1);

$test->getByTeacherId(1);

$test->getAll();

$test->deleteByTeacherId(1);

$teacherDefaultHoliday = array();
$teacherDefaultHoliday['teacherid'] = 2;
$teacherDefaultHoliday['week1'] = true;
$teacherDefaultHoliday['week4'] = true;
$test->add($teacherDefaultHoliday);

$list = $test->getAll();
foreach ( $list as $teacherDefaultHoliday){
    if($teacherDefaultHoliday['teacherid'] == 2){
        $teacherDefaultHoliday['week3'] = true;
        $teacherDefaultHoliday['week6'] = true;
        $test->update($teacherDefaultHoliday);
    }
}
*/

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
    }

    public function update($teacherHoliday){
        $teacherHoliday['isholiday'] = $this->bool2String($teacherHoliday['isholiday']);
        $sql = "update " . self::TABLENAME . " set teacherid=$teacherHoliday[teacherid], adjustdate='$teacherHoliday[adjustdate]', isholiday=$teacherHoliday[isholiday] " .
            "where id = $teacherHoliday[id]";
        $this->executeUpdateSql($sql);
    }
}

/*
$test = new PDOTeacherHolidayOperation();
$test->get(2);
$test->getAll();
$test->getByTeacherId(2);
$test->getByTeacherAndDate(2, "1989-7-21");

$teacherHoliday = array();
$teacherHoliday['teacherid'] = 2;
$teacherHoliday['adjustdate'] = "1989-07-23";
$teacherHoliday['isholiday'] = true;
$test->add($teacherHoliday);

$list = $test->getAll();
foreach ( $list as $teacherHoliday){
    if($teacherHoliday['teacherid'] == 2){
        $teacherHoliday['adjustdate'] = "1985-06-20";
        $teacherHoliday['isholiday'] = false;
        $test->update($teacherHoliday);
    }
}

*/

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

$test = new PDOScheduleOperation();
$test->get(1);

$test->getByStudentIdOnDateAndTime(1, "1989-07-23", 1);

$test->getByStudentId(1);

$test->getByTeacherId(1);

$test->getAll();

$test->getByDateAndTime("1989-07-23", 1);

$schedule =array();
$schedule['ondate'] = "1989-07-23";
$schedule['ontime'] = 1;
$schedule['studentid'] = 1;
$schedule['courseid'] = 1;
$schedule['teacherid'] = 1;
$test->add($schedule);

$schedule['ontime'] = 2;
$schedule['id'] = 1;
$test->update($schedule);