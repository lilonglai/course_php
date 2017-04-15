<?php
require __DIR__ . "/bussiness/TeacherBusinessOperation.php";

if(isset($_GET["status"])){
    $status = $_GET["status"];
}
else{
    $status = 1;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title>老师</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js" ></script>
    <script type="text/javascript">
        function modifyTeacher(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","teacherUpdate.php");
            $("#teacherForm").submit();
        }

        function deleteTeacher(teacherId) {
            $.ajax({
                url: "api/teacherdefaultholiday/deleteByTeacherId",
                context: document.body,
                type: "DELETE",
                data: {id: teacherId }
            }).done(function () {
                $.ajax({
                    url: "api/teacher/delete",
                    context: document.body,
                    type: "DELETE",
                    data: {id: teacherId }
                }).done(function () {
                    alert("success delete a teacher");
                    $("#teacherForm").attr("action","teacher.php" );
                    $("#teacherForm").submit();

                }).fail(function (data) {
                    alert("fail to delete a teacher:" + data.statusText);
                });
            }).fail(function (data) {
                alert("fail to delete a teacher:" + data.statusText);
            });

        }

        function retireTeacher(teacherId) {
            $.ajax({
                url: "api/teacher/retire",
                context: document.body,
                type: "PUT",
                data: {id: teacherId }
            }).done(function () {
                alert("success retire a teacher");
                $("#teacherForm").attr("action","teacher.php" );
                $("#teacherForm").submit();
            }).fail(function (data) {
                alert("fail to retire a teacher:" + data.statusText);
            });
        }

        function addTeacher() {
            $("#teacherForm").attr("action","teacherAdd.php");
            $("#teacherForm").submit();
        }

        function modifyTeacherHoliday(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","teacherHoliday.php");
            $("#teacherForm").submit();
        }

        function modifyTeacherAbility(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","teacherAbility.php");
            $("#teacherForm").submit();
        }
    </script>
</head>

<body>

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
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
</div>

<div class="container">

    <form action="teacher.php" method="get" name="statusForm" id="statusForm">
        <select name="status" onChange="document.getElementById('statusForm').submit()">
            <?php
            if($status == 1){
                echo '<option value="1" selected>所有老师</option>';
            }
            else{
                echo '<option value="1">所有老师</option>';
            }

            if($status == 2){
                echo '<option value="2" selected>在职老师</option>';
            }
            else{
                echo '<option value="2">在职老师</option>';
            }

            if($status == 3){
                echo '<option value="3" selected>离职老师</option>';
            }
            else{
                echo '<option value="3">离职老师</option>';
            }
            ?>
        </select>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>简称</th>
                <th>电话</th>
                <th>是否为班主任</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $teacherOperation = new TeacherBusinessOperation();
            if($status == 1){
                $teacherList =  $teacherOperation->getAll();
            }
            else if($status == 2){
                $teacherList =  $teacherOperation->getAlive();
            }
            else if($status == 3){
                $teacherList =  $teacherOperation->getNotAlive();
            }
            for($index = 0; $index < count($teacherList); $index++){
                $teacher = $teacherList[$index];
                echo "<tr>";
                echo "<td>", $index, "</td>";
                echo "<td>", $teacher->name, "</td>";
                echo "<td>", $teacher->shortName, "</td>";
                echo "<td>", $teacher->phone, "</td>";
                if($teacher->isMaster){
                    echo '<td><input type="checkbox" name="isMaster" checked disabled/></td>';
                }
                else{
                    echo' <td><input type="checkbox" name="isMaster" disabled/></td>';
                }
                echo '<td><input type="button" class="btn btn-default" value="修改"';
                echo 'onclick="modifyTeacher(',$teacher->id, ')">';
                echo '<input type="button" class="btn btn-default" value="删除"';
                echo 'onclick="deleteTeacher(', $teacher->id, ')">';
                if($teacher->isAlive){
                    echo '<input type="button" class="btn btn-default" value="离职"';
                    echo 'onclick="retireTeacher(', $teacher->id, ')">';
                    echo '<input type="button" class="btn btn-default" value="修改假期"';
                    echo 'onclick="modifyTeacherHoliday(', $teacher->id, ')">';
                    echo '<input type="button" class="btn btn-default" value="修改能力"';
                    echo 'onclick="modifyTeacherAbility(', $teacher->id, ')">';
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>

            </tbody>
        </table>
    </div>

    <input type="button" class="btn btn-default" value='增加' onclick="addTeacher()">

    <form method="get" action="teacher.jsp" name="teacherForm" id="teacherForm">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="action" id="action">
    </form>
</div>
</body>
</html>