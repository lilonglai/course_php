<?php
require __DIR__ . "/bussiness/StudentBusinessOperation.php";
require __DIR__ . "/bussiness/TeacherBusinessOperation.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
}
else{
    echo "course id is not set";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>增加新课程</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script src="js/Calendar3.js">
    </script>

    <script type="text/javascript">
        function checkForm() {
            if ($("[name='name']").val().length == 0) {
                alert("学生名字不能为空")
                return false;
            }

            $.ajax({
                url: "api/student/add",
                context: document.body,
                type: "POST",
                data: {name: $("[name='name']").val(), shortName: $("[name='shortName']").val(), grade: $("[name='grade']").val(),
                    testScore: $("[name='testScore']").val(), targetScore: $("[name='targetScore']").val(),
                    examineDate: $("[name='examineDate']").val(), examinePlace: $("[name='examinePlace']").val(),
                    teacherId: $("[name='teacherId']").val(), description: $("[name='description']").val() }
            }).done(function () {
                alert("success add a first course");
            }).fail(function (data) {
                alert("fail to add a first course:" + data.statusText);
            });

            return false;
        }
    </script>
</head>
<body>
<div class="container">
    <form action="studentAddSubmit.html" method="get" onSubmit="return checkForm();">
        <input type="hidden" name="action" value="add">

        <div class="form-group">
            学生姓名: <input type="text" name="name"/>
        </div>
        <div class="form-group">
            学生简称: <input type="text" name="shortName"/>
        </div>
        <div class="form-group">
            年级:
            <input type="radio" name="grade" value="1"> 4-6
            <input type="radio" name="grade" value="2"> 7-9
            <input type="radio" name="grade" value="3"> 10-12
        </div>
        <div class="form-group">
            测试成绩: <input type="text" name="testScore"/>
        </div>
        <div class="form-group">
            目标分数: <input type="text" name="targetScore"/>
        </div>
        <div class="form-group">
            考试时间:
			<span> <input name="examineDate" type="text" id="examineDate" size="10"
                          maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"/>
            </span>
        </div>
        <div class="form-group">
            考试地点: <input type="text" name="examinePlace"/>
        </div>
        <div class="form-group">
            班主任:
            <select name="teacherId">
                <?php
                $teacherOperator = new TeacherBusinessOperation();
                $teacherList = $teacherOperator->getAll();
                foreach ($teacherList as $teacher){
                    echo '<option value="',$teacher->id, '" >', $teacher->name, '</option>';
                }
                ?>
            </select>

        </div>
        <div class="form-group">
            学生描述: <textarea rows="4" cols="25" name="description"> </textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交" name="submit"/>
        </div>
    </form>
</div>
</body>
</html>