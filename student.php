<?php
require __DIR__ . "/bussiness/StudentBusinessOperation.php";
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
    <title>学生</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js" ></script>
    <script src="js/Calendar3.js">
    </script>

    <script type="text/javascript">
        function modifyStudent(studentId) {
            $("#id").val(studentId);
            $("#studentForm").attr("action", "studentUpdate.php");
            $("#studentForm").submit();
        }

        function deleteStudent(studentId) {
            $.ajax({
                url: "api/student/delete",
                context: document.body,
                type: "DELETE",
                data: {id: studentId }
            }).done(function () {
                alert("success delete a student");
                $("#studentForm").attr("action","student.php" );
                $("#studentForm").submit();
            }).fail(function (data) {
                alert("fail to delete a student:" + data.statusText);
            });
        }

        function retireStudent(studentId) {
            $.ajax({
                url: "api/student/retire",
                context: document.body,
                type: "PUT",
                data: {id: studentId }
            }).done(function () {
                alert("success retire a student");
                $("#studentForm").attr("action","student.php" );
                $("#studentForm").submit();
            }).fail(function (data) {
                alert("fail to retire a student:" + data.statusText);
            });
        }

        function addStudent() {
            $("#studentForm").attr("action", "studentAdd.php");
            $("#studentForm").submit();
        }

        function scheduleCourse(studentId) {
            $("#id").val(studentId);
            $("#studentForm").attr("action", "schedule.php");
            $("#studentForm").submit();
        }

        function importCourse() {
            var form = document.getElementById("importForm");
            if (form.excelFile.value.length == 0) {
                alert("文件不能为空")
                return false;
            }
            var index = form.excelFile.value.indexOf('.xls');
            if (form.excelFile.value.length - index != 4) {
                alert("文件必须是excel")
                return false;
            }
            form.submit();
        }

        function exportReport() {
            if ($("#start_date").val().length == 0) {
                alert("开始时间不能为空")
                return false;
            }
            $("#exportReportForm").submit();
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
    <form action="importCourse.jsp" enctype="multipart/form-data" method="post" name="importForm" id="importForm">
        <input type="file" name="excelFile">
        <input type="button" class="btn btn-default" value="导入课表" id="importData" onclick="importCourse()">
    </form>
    <br>

    <form action="exportReport.jsp" method="get" name="exportReportForm" id="exportReportForm">
        <span>选择开始日期：</span>
	     <span>
	        <input name="start_date" type="text" id="start_date" size="10"
                   maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"/>
	     </span>

        <span>选择结束日期：</span>
	     <span>
	        <input name="end_date" type="text" id="end_date" size="10"
                   maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"/>
	     </span>

        <input type="button" class="btn btn-default" value="生成总表" onclick="exportReport()">
    </form>

    <br>

    <form action="student.php" method="get" name="statusForm" id="statusForm">
        <select name="status" onChange="document.getElementById('statusForm').submit()">
            <?php
            if($status == 1){
                echo '<option value="1" selected>所有学生</option>';
            }
            else{
                echo '<option value="1">所有学生</option>';
            }

            if($status == 2){
                echo '<option value="2" selected>在职学生</option>';
            }
            else{
                echo '<option value="2">在职学生</option>';
            }

            if($status == 3){
                echo '<option value="3" selected>毕业学生</option>';
            }
            else{
                echo '<option value="3">毕业学生</option>';
            }
            ?>
        </select>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>学生姓名</th>
                <th>学生简称</th>
                <th>年级</th>
                <th>测试成绩</th>
                <th>目标分数</th>
                <th>考试时间</th>
                <th>考试地点</th>
                <th>班主任</th>
                <th>学生描述</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $studentOperation = new StudentBusinessOperation();
            $teacherOperation = new TeacherBusinessOperation();
            if($status == 1){
                $studentList =  $studentOperation->getAll();
            }
            else if($status == 2){
                $studentList =  $studentOperation->getAlive();
            }
            else if($status == 3){
                $studentList =  $studentOperation->getNotAlive();
            }
            for($index = 0; $index < count($studentList); $index++){
                $student = $studentList[$index];
                $teacher = $teacherOperation->get($student->teacherId);
                echo "<tr>";
                echo "<td>", $student->name, "</td>";
                echo "<td>", $student->shortName, "</td>";
                if($student->grade == 1){
                    echo "<td>", 4-6, "</td>";
                }
                else if($student->grade == 2){
                    echo "<td>", 7-9, "</td>";
                }
                else if($student->grade == 3){
                    echo "<td>", 10-12, "</td>";
                }
                else{
                    echo "<td>", "</td>";
                }
                echo "<td>", $student->testScore, "</td>";
                echo "<td>", $student->targetScore, "</td>";
                echo "<td>", $student->examineDate, "</td>";
                echo "<td>", $student->examinePlace, "</td>";
                if($teacher != null){
                    echo "<td>", $teacher->name, "</td>";
                }
                else{
                    echo "<td>", "</td>";
                }
                echo "<td>", $student->description, "</td>";
                echo '<td><input type="button" class="btn btn-default" value="修改"';
                echo 'onclick="modifyStudent(',$student->id, ')">';
                echo '<input type="button" class="btn btn-default" value="删除"';
                echo 'onclick="deleteStudent(', $student->id, ')">';
                if($status == 2){
                    echo '<input type="button" class="btn btn-default" value="毕业"';
                    echo 'onclick="retireStudent(', $student->id, ')">';
                    echo '<input type="button" class="btn btn-default" value="排课"';
                    echo 'onclick="scheduleCourse(', $student->id, ')">';
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>

            </tbody>
        </table>

    </div>

    <input type="button" class="btn btn-default" value='增加' onclick="addStudent()">

    <form method="get" action="student.jsp" name="studentForm" id="studentForm">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="status" value="${status}">
    </form>

</div>
</body>
</html>