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
        $sql = "insert into " . self::TABLENAME . "(name,shortname,phone,ismaster) values(
        '$teacher[name]', '$teacher[shortname]', '$teacher[phone]', $teacher[ismaster])";
        $this->executeUpdateSql($sql);
    }

    public function update($teacher){
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