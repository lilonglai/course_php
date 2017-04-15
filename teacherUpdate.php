<?php
require __DIR__ . "/bussiness/TeacherBusinessOperation.php";
require __DIR__. "/bussiness/TeacherDefaultHolidayBusinessOperation.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
}
else{
    echo "course id is not set";
}

$teacherOperator = new TeacherBusinessOperation();
$teacherDefaultHolidayOperator = new TeacherDefaultHolidayBusinessOperation();
$teacher = $teacherOperator->get($id);
$teacherDefaultHoliday = $teacherDefaultHolidayOperator->getByTeacherId($teacher->id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改老师信息</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js" ></script>
    <script type="text/javascript">
        function checkForm() {
            if ($("[name='name']").val().length == 0) {
                alert("老师名字不能为空")
                return false;
            }

            $.ajax({
                url: "api/teacher/update",
                context: document.body,
                type: "PUT",
                data: {id: $("[name='id']").val(), name: $("[name='name']").val(), shortName: $("[name='shortName']").val(),
                    phone: $("[name='phone']").val(), isMaster: $("[name='isMaster']").val() }
            }).done(function () {
                var weeksVal =[];
                $("[name='weeks']:checked").each(function () {
                    weeksVal.push($(this).val());
                })
                $.ajax({
                    url: "api/teacherdefaultholiday/update",
                    context: document.body,
                    type: "PUT",
                    data: {id: $("[name='id2']").val(), teacherId: $("[name='id']").val(),  weeks: weeksVal }
                }).done(function () {
                    alert("success update a teacher");
                    //window.location.replace("teacher.php");
                }).fail(function (data) {
                    alert("fail to update a teacher:" + data.statusText);
                });
            }).fail(function (data) {
                alert("fail to update a teacher:" + data.statusText);
            });

            return false;
        }
    </script>
</head>
<body>

<div class="container">
    <form action="teacherUpdateSubmit.php" method="get" onSubmit="return checkForm();">
        <input type="hidden" name="id" value="<?php echo $teacher->id; ?>">

        <div class="form-group">
            名称: <input type="text" class="form-control" name="name" value="<?php echo $teacher->name; ?>"/>
        </div>
        <div class="form-group">
            简称: <input type="text" class="form-control" name="shortName" value="<?php echo $teacher->shortName; ?>"/>
        </div>
        <div class="form-group">
            电话: <input type="text" class="form-control" name="phone" value="<?php echo $teacher->phone; ?>"/>
        </div>
        <div class="form-group">
            <?php
            if($teacher->isMaster){
                echo '班主任: <input type="checkbox" name="isMaster" checked/> <br>';
            }
            else{
                echo '班主任: <input type="checkbox" name="isMaster"/> <br>';
            }
            ?>
        </div>
        <div class="form-group">
            默认休假情况:<br>

            <?php
            if($teacherDefaultHoliday != null){
                echo '<input type="hidden" name="id2" value="', $teacherDefaultHoliday->id, '">';
                if($teacherDefaultHoliday->week1){
                    echo '周一 <input type="checkbox" name="weeks" value="week1" checked>';
                }
                else{
                    echo '周一 <input type="checkbox" name="weeks" value="week1">';
                }
                if($teacherDefaultHoliday->week2){
                    echo '周二 <input type="checkbox" name="weeks" value="week2" checked>';
                }
                else{
                    echo '周二 <input type="checkbox" name="weeks" value="week2">';
                }
                if($teacherDefaultHoliday->week3){
                    echo '周三 <input type="checkbox" name="weeks" value="week3" checked>';
                }
                else{
                    echo '周三 <input type="checkbox" name="weeks" value="week3">';
                }
                if($teacherDefaultHoliday->week4){
                    echo '周四 <input type="checkbox" name="weeks" value="week4" checked>';
                }
                else{
                    echo '周四 <input type="checkbox" name="weeks" value="week4">';
                }
                if($teacherDefaultHoliday->week5){
                    echo '周五 <input type="checkbox" name="weeks" value="week5" checked>';
                }
                else{
                    echo '周五 <input type="checkbox" name="weeks" value="week5">';
                }
                if($teacherDefaultHoliday->week6){
                    echo '周六 <input type="checkbox" name="weeks" value="week6" checked>';
                }
                else{
                    echo '周六 <input type="checkbox" name="weeks" value="week6">';
                }
                if($teacherDefaultHoliday->week7){
                    echo '周日 <input type="checkbox" name="weeks" value="week7" checked>';
                }
                else{
                    echo '周日 <input type="checkbox" name="weeks" value="week7">';
                }
            }
            else{
                echo '周一 <input type="checkbox" name="weeks" value="week1">';
                echo '周二 <input type="checkbox" name="weeks" value="week2">';
                echo '周三 <input type="checkbox" name="weeks" value="week3">';
                echo '周四 <input type="checkbox" name="weeks" value="week4">';
                echo '周五 <input type="checkbox" name="weeks" value="week5">';
                echo '周六 <input type="checkbox" name="weeks" value="week6">';
                echo '周日 <input type="checkbox" name="weeks" value="week7">';
            }
            ?>

        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交"/>
        </div>
    </form>

</div>
</body>
</html>