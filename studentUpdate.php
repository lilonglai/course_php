<?php
require __DIR__ . "/bussiness/StudentBusinessOperation.php";
require __DIR__ . "/bussiness/TeacherBusinessOperation.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
}
else{
    echo "course id is not set";
}

$studentOperator = new StudentBusinessOperation();
$student = $studentOperator->get($id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改老师信息</title>
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
                url: "api/student/update",
                context: document.body,
                type: "PUT",
                data: {id: $("[name='id']").val(), name: $("[name='name']").val(), shortName: $("[name='shortName']").val(), grade: $("[name='grade']").val(),
                    testScore: $("[name='testScore']").val(), targetScore: $("[name='targetScore']").val(),
                    examineDate: $("[name='examineDate']").val(), examinePlace: $("[name='examinePlace']").val(),
                    teacherId: $("[name='teacherId']").val(), description: $("[name='description']").val() }
            }).done(function () {
                alert("success update a first course");
                window.location.replace("student.php");
            }).fail(function (data) {
                alert("fail to update a first course:" + data.statusText);
            });

            return false;
        }
    </script>
</head>
<body>

<div class="container">
    <form action="studentUpdateSubmit.html" method="get" onSubmit="return checkForm();">
        <input type="hidden" name="id" value="<?php echo $student->id; ?> ">

        <div class="form-group">
            学生姓名: <input type="text" name="name" value="<?php echo $student->name; ?> "/>
        </div>
        <div class="form-group">
            学生简称: <input type="text" name="shortName" value="<?php echo $student->shortName; ?>"/>
        </div>
        <div class="form-group">
            年级:
            <?php
            if($student->grade == 1){
                echo '<input type="radio" name="grade" value="1" checked> 4-6';
            }
            else{
                echo '<input type="radio" name="grade" value="1"> 4-6';
            }

            if($student->grade == 2){
                echo '<input type="radio" name="grade" value="2" checked> 7-9';
            }
            else{
                echo '<input type="radio" name="grade" value="2"> 7-9';
            }

            if($student->grade == 3){
                echo '<input type="radio" name="grade" value="3" checked> 10-12';
            }
            else{
                echo '<input type="radio" name="grade" value="3"> 10-12';
            }

            ?>

        </div>
        <div class="form-group">
            测试成绩: <input type="text" name="testScore" value="<?php echo $student->testScore; ?>"/>
        </div>
        <div class="form-group">
            目标分数: <input type="text" name="targetScore" value="<?php echo $student->targetScore; ?>"/>
        </div>
        <div class="form-group">
            考试时间:
		    <span> <input name="examineDate" type="text" id="examineDate" size="10"
                          maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"
                          value="<?php echo $student->examineDate; ?>"/>
            </span><br>
            考试地点: <input type="text" name="examinePlace" value="<?php echo $student->examinePlace; ?>"/>
        </div>
        <div class="form-group">
            班主任:
            <select name="teacherId">
                <?php
                $teacherOperator = new TeacherBusinessOperation();
                $teacherList = $teacherOperator->getAll();
                foreach ($teacherList as $teacher){
                    if($teacher->id == $student->teacherId){
                        echo '<option value="',$teacher->id, '" selected>', $teacher->name, '</option>';
                    }
                    else{
                        echo '<option value="',$teacher->id, '" >', $teacher->name, '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            学生描述:
            <textarea rows="4" cols="25" name="description"> <?php echo $student->description; ?> </textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交" name="submit"/>
        </div>
    </form>
</div>
</body>
</html>