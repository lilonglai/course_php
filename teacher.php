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
            $("#teacherForm").attr("action","teacherUpdate.html");
            $("#teacherForm").submit();
        }

        function deleteTeacher(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","teacherDelete.html");
            $("#teacherForm").submit();
        }

        function retireTeacher(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","retire.html");
            $("#teacherForm").submit();
        }

        function addTeacher() {
            $("#teacherForm").attr("action","teacherAdd.php");
            $("#teacherForm").submit();
        }

        function modifyTeacherHoliday(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","teacherHoliday.html");
            $("#teacherForm").submit();
        }

        function modifyTeacherAbility(teacherId) {
            $("#id").val(teacherId);
            $("#teacherForm").attr("action","teacherHoliday.html");
            $("#teacherForm").submit();
        }
    </script>
</head>

<body>
<?php
@$status = $_GET['status'];
if($status == null){
    $status = 2;
}
?>
<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">排课系统</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./course.php">课程信息</a></li>
                <li><a href="./teacher.php">老师信息</a></li>
                <li><a href="./student.php">学生信息</a></li>
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
            if($status  == 1) {
                echo '<option value="1" selected> 所有老师</option>';
            }
            else{
                echo '<option value="1"> 所有老师</option>';
            }

            if($status  == 2) {
                echo '<option value="2" selected> 在职老师</option>';
            }
            else{
                echo '<option value="2"> 在职老师</option>';
            }

            if($status  == 3) {
                echo '<option value="3" selected>离职老师</option>';
            }
            else{
                echo '<option value="3"> 离职老师</option>';
            }
            ?>
        </select>
    </form>

    <?php
    require "db.php";
    $teacherOperation = new PDOTeacherOperation();
    switch ($status){
        case 1:
            $teacherList = $teacherOperation->getAll();
            break;
        case 2:
            $teacherList = $teacherOperation->getAlive();
            break;
        case 3:
            $teacherList = $teacherOperation->getNotAlive();
            break;
        default:
            $teacherList = null;
            break;
    }

    ?>

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
            $teacherIndex = 0;
            foreach($teacherList as $teacher) {
                $teacherIndex++;
            ?>

                <tr>
                    <td><?php echo $teacherIndex?></td>
                    <td><?php echo $teacher['name']?></td>
                    <td><?php echo $teacher['shortname']?></td>
                    <td><?php echo $teacher['phone']?></td>
                    <?php
                    if($teacher['ismaster'] == true){
                        echo '<td><input type="checkbox" name="isMaster" checked disabled/></td>';
                    }
                    else{
                        echo '<td><input type="checkbox" name="isMaster" disabled/></td>';
                    }
                    ?>

                    <td><input type="button" class="btn btn-default" value='修改' onclick="modifyTeacher(${teacher.id})">
                        <input type="button" class="btn btn-default" value='删除' onclick="deleteTeacher(${teacher.id})">
                        <?php
                        if($teacher['isalive'] == true) {
                         ?>
                            <input type="button" class="btn btn-default" value='离职'
                                   onclick="retireTeacher(${teacher.id})">
                            <input type="button" class="btn btn-default" value='修改假期'
                                   onclick="modifyTeacherHoliday(${teacher.id})">
                            <input type="button" class="btn btn-default" value='修改能力'
                                   onclick="modifyTeacherAbility(${teacher.id})">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

            <?php
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