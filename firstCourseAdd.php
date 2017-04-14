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
            if ($("[name='grade']").val().length == 0) {
                alert("请选择一个年级")
                return false;
            }

            $.ajax({
                url: "api/firstcourse/add",
                context: document.body,
                type: "POST",
                data: {name: $("[name='name']").val(), shortName: $("[name='shortName']").val(), grade: $("[name='grade']").val(), description: $("[name='description']").val() }
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

<?php
if(isset($_GET["grade"])){
    $grade = $_GET["grade"];
}
else{
    $grade = 1;
}
?>
<div class="container">
    <form action="firstCourseAddSubmit.html" role="form" method="get" onSubmit="return checkForm();">
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
            <label for="name" class="col-sm-2 control-label">课程名称:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name"/>
            </div>
        </div>
        <div class="form-group">
            <label for="shortName" class="col-sm-2 control-label">课程简称:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="shortName" id="shortName"/>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">课程描述:</label>

            <div class="col-sm-10">
                <textarea class="form-control" rows="4" cols="25" name="description" id="description"> </textarea>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交"/>
        </div>
    </form>
</div>

</body>
</html>