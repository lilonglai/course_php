<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>课程</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript">
        function modifyFirstCourse(courseId) {
            $("#firstCourseForm [name='id']").val(courseId);
            $("#firstCourseForm").attr("action","firstCourseUpdate.php" );
            $("#firstCourseForm").submit();
        }

        function deleteFirstCourse(courseId) {
            /*
            change it to ajaxcall
             */
            $("#firstCourseForm [name='id']").val(courseId);
            $("#firstCourseForm").attr("action","firstCourseDelete.html" );
            $("#firstCourseForm").submit();
        }

        function addFirstCourse(grade) {
            $("#firstCourseForm").attr("action","firstCourseAdd.php" );
            $("#firstCourseForm").submit();
        }


        function modifySecondCourse(courseId) {
            $("#secondCourseForm [name='id']").val(courseId);
            $("#secondCourseForm").attr("action","secondCourseUpdate.php" );
            $("#secondCourseForm").submit();
        }

        function deleteSecondCourse(courseId) {
            $("#secondCourseForm [name='id']").val(courseId);
            $("#secondCourseForm").attr("action","secondCourseDelete.php" );
            $("#secondCourseForm").submit();
        }

        function addSecondCourse(firstCourseId) {
            $("#secondCourseForm [name='id']").val(firstCourseId);
            $("#secondCourseForm").attr("action","secondCourseAdd.php" );
            $("#secondCourseForm").submit();
        }

        function gradeChanged() {
            $("#gradeForm").submit();
        }

    </script>
</head>

<body>

<?php
require __DIR__ . "/bussiness/FirstCourseBusinessOperation.php";
require __DIR__ . "/bussiness/SecondCourseBusinessOperation.php";
if(isset($_GET["grade"])){
    $grade = $_GET["grade"];
}
else{
    $grade = 1;
}

?>

<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">排课系统</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./course.html">课程信息</a></li>
                <li><a href="./teacher.html">老师信息</a></li>
                <li><a href="./student.html">学生信息</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <form method="get" action="course.php" name="gradeForm" id="gradeForm">
        选择年级:
        <select name="grade" onChange="gradeChanged();">
            <?php
            if($grade == 1){
                echo '<option value="1" selected>4-6</option>';
            }
            else{
                echo '<option value="1">4-6</option>';
            }

            if($grade == 2){
                echo '<option value="2" selected>7-9</option>';
            }
            else{
                echo '<option value="2">7-9</option>';
            }

            if($grade == 3){
                echo '<option value="3" selected>10-12</option>';
            }
            else{
                echo '<option value="3">10-12</option>';
            }
            ?>
        </select>
    </form>
    <br>
    课程分类:<br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>课程名称</th>
                <th>课程简称</th>
                <th>课程描述</th>
                <th>操作</th>
            </tr>
            <thead>
            <tbody>

            <?php
            $firstCourseOperation = new FirstCourseBusinessOperation();
            $firstCourseList = $firstCourseOperation->getByGrade($grade);
            for ($index =0 ; $index < count($firstCourseList); $index++){
                $firstCourse = $firstCourseList[$index];
                echo "<tr>";
                echo "<td>$index</td>";
                echo "<td>", $firstCourse->name, "</td>";
                echo "<td>", $firstCourse->shortName, "</td>";
                echo "<td>", $firstCourse->description, "</td>";
                echo '<td><input type="button" class="btn btn-default" value="修改"';
                echo 'onclick="modifyFirstCourse(', $firstCourse->id, ')">';
                echo '<input type="button" class="btn btn-default" value="删除"';
                echo 'onclick="deleteFirstCourse(', $firstCourse->id, ')">';
                echo '<input type="button" class="btn btn-default" value="增加具体课程"';
                echo 'onclick="addSecondCourse(', $firstCourse->id, ')">';
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <input type="button" class="btn btn-default" value='增加课程' onclick="addFirstCourse(<?php echo $grade; ?>)">

    <br> <br>
    课程详细信息:<br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>课程名称</th>
                <th>课程简称</th>
                <th>课程分类</th>
                <th>课程描述</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $secondCourseOperation = new SecondCourseBusinessOperation();
            $secondCourseList =  $secondCourseOperation->getByGrade($grade);
            for($index = 0; $index < count($secondCourseList); $index++){
                $secondCourse = $secondCourseList[$index];
                $firstCourse = $firstCourseOperation->get($secondCourse->firstCourseId);
                echo "<tr>";
                echo "<td>", $index, "</td>";
                echo "<td>", $secondCourse->name, "</td>";
                echo "<td>", $secondCourse->shortName, "</td>";
                echo "<td>", $firstCourse->name, "</td>";
                echo "<td>", $secondCourse->description, "</td>";
                echo '<td><input type="button" class="btn btn-default" value="修改"';
                echo 'onclick="modifySecondCourse(', $secondCourse->id, ')">';
                echo '<input type="button" class="btn btn-default" value="删除"';
                echo 'onclick="deleteSecondCourse(', $secondCourse->id, ')">';
            }
            ?>

            </tbody>
        </table>
    </div>


    <form method="get" action="course.jsp" name="firstCourseForm" id="firstCourseForm">
        <input type="hidden" name="id">
        <input type="hidden" name="grade" value="<?php echo $grade; ?>">
    </form>

    <form method="get" action="course.jsp" name="secondCourseForm" id="secondCourseForm">
        <input type="hidden" name="id">
        <input type="hidden" name="grade" value="<?php echo $grade; ?>">
    </form>

</div>
</body>
</html>