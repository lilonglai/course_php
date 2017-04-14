<?php
require __DIR__ . "/bussiness/FirstCourseBusinessOperation.php";
require __DIR__ . "/bussiness/SecondCourseBusinessOperation.php";
if(isset($_GET["grade"])){
    $grade = $_GET["grade"];
}
else{
    $grade = 1;
}

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
    <script type="text/javascript">
        function checkForm() {
            if ($("[name='name']").val().length == 0) {
                alert("课程名字不能为空")
                return false;
            }

            $.ajax({
                url: "api/secondcourse/add",
                context: document.body,
                type: "POST",
                data: {name: $("[name='name']").val(), shortName: $("[name='shortName']").val(), firstCourseId: $("[name='firstCourseId']").val(), description: $("[name='description']").val() }
            }).done(function () {
                alert("success add a second course");
            }).fail(function (data) {
                alert("fail to add a second course:" + data.statusText);
            });

            return false;
        }
    </script>
</head>
<body>
<div class="container">
    <form action="course.php" method="get" onSubmit="return checkForm();">
        <div class="form-group">
            课程名称: <input type="text" name="name"/>
        </div>
        <div class="form-group">
            课程简称: <input type="text" name="shortName"/>
        </div>
        <div class="form-group">
            课程分类: <select name="firstCourseId">
                <?php
                $firstCourseOperator = new FirstCourseBusinessOperation();
                $firstCourseList = $firstCourseOperator->getByGrade($grade);
                foreach ($firstCourseList as $firstCourse){
                    if($firstCourse->id == $id){
                        echo '<option value="',$firstCourse->id, '" selected>', $firstCourse->name, '</option>';
                    }
                    else{
                        echo '<option value="',$firstCourse->id, '" >', $firstCourse->name, '</option>';
                    }
                }
                ?>
        </select>
        </div>
        <div class="form-group">
            课程描述: <textarea rows="4" cols="25" name="description"> </textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交" name="submit"/>
        </div>
    </form>

</div>
</body>
</html>