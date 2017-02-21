<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/21
 * Time: 21:14
 */

class PDOBaseOperation{
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
}

$test = new PDOSecondCourseOperation();
$test->getByGrade(1);

/*
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
