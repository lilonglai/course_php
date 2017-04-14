<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改老师信息</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript">
        function checkForm() {
            if ($("[name='name']").val().length == 0) {
                alert("课程名字不能为空")
                return false;
            }
            if ($("[name='grade']").val().length == 0) {
                alert("请选择一个年级")
                return false;
            }

            $.ajax({
                url: "api/firstcourse/update",
                context: document.body,
                type: "PUT",
                data: {id: $("[name='id']").val(), name: $("[name='name']").val(), shortName: $("[name='shortName']").val(), grade: $("[name='grade']").val(), description: $("[name='description']").val() }
            }).done(function () {
                alert("success update a first course");
            }).fail(function (data) {
                alert("fail to update a first course:" + data.statusText);
            });

            return false;
        }
    </script>
</head>
<body>

<?php
require __DIR__ . "/bussiness/FirstCourseBusinessOperation.php";
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

$firstCourseOperator = new FirstCourseBusinessOperation();
$firstCourse = $firstCourseOperator->get($id);

?>

<div class="container">
    <form action="firstCourseUpdateSubmit.html" method="get" onSubmit="return checkForm();">
        <input type="hidden" name="id" value="<?php echo $firstCourse->id; ?> ">

        <div class="form-group">
            年级:
            <?php
            if($grade == 1){
                echo '<input type="radio" name="grade" value="1" checked> 4-6';
            }
            else{
                echo '<input type="radio" name="grade" value="1"> 4-6';
            }

            if($grade == 2){
                echo '<input type="radio" name="grade" value="2" checked>7-9';
            }
            else{
                echo '<input type="radio" name="grade" value="2">7-9';
            }

            if($grade == 3){
                echo '<input type="radio" name="grade" value="3" checked> 10-12';
            }
            else{
                echo '<input type="radio" name="grade" value="3"> 10-12';
            }
            ?>

        </div>
        <div class="form-group">
            课程名称: <input type="text" name="name" value="<?php echo $firstCourse->name; ?>"/>
        </div>
        <div class="form-group">
            课程简称: <input type="text" name="shortName" value="<?php echo $firstCourse->shortName; ?> "/>
        </div>
        <div class="form-group">
            课程描述:
            <textarea rows="4" cols="25" name="description"> <?php echo $firstCourse->description; ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交"/>
        </div>
    </form>
</div>
</body>
</html>