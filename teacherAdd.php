<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>增加新老师</title>
<link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js" ></script>
    <script type="text/javascript">
    function checkForm(){
		if ($("[name='name']").val().length == 0) {
			alert("老师名字不能为空")
			return false;
		}

		$.ajax({
			url: "api/teacher/add",
			context: document.body,
			type: "POST",
			data: {name: $("[name='name']").val(), shortName: $("[name='shortName']").val(),
				phone: $("[name='phone']").val(), isMaster: $("[name='isMaster']").val() }
		}).done(function (data) {
			var weeksVal =[];
			$("[name='weeks']:checked").each(function () {
				weeksVal.push($(this).val());
			})
			$.ajax({
				url: "api/teacherdefaultholiday/add",
				context: document.body,
				type: "POST",
				data: {teacherId: data.id,  weeks: weeksVal }
			}).done(function () {
				alert("success add a teacher");
			}).fail(function (data) {
				alert("fail to update a teacher:" + data.statusText);
			});
		}).fail(function (data) {
			alert("fail to add a teacher:" + data.statusText);
		});

		return false;
    }
</script>

</head>
<body>
  <div class="container">
	<form action="teacherAddSubmit.html" role="form" method="get" onSubmit="return checkForm();">
	    <input type="hidden" name="action" value="add">
	    <div class="form-group">
			名称: <input type="text" class="form-control" name="name" />
		</div>
		<div class="form-group">
			简称: <input type="text" class="form-control" name="shortName" />
		</div>
		<div class="form-group">
			电话: <input type="text" class="form-control" name="phone" />
		</div>
		<div class="form-group">
			班主任: <input type="checkbox" name="isMaster" />
		</div>
		<div class="form-group">
			默认休假情况:<br> &nbsp;&nbsp;
			<label class="checkbox-inline">
			 <input type="checkbox" name="weeks" value="week1"> 周一
			</label>
			<label class="checkbox-inline">
			 <input type="checkbox" name="weeks" value="week2"> 周二
			</label>
			<label class="checkbox-inline">
			 <input type ="checkbox" name="weeks" value="week3">周三
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="weeks" value="week4"> 周四
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="weeks" value="week5">周五
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="weeks" value="week6">周六
			</label>
			<label class="checkbox-inline">
			<input type="checkbox" name="weeks" value="week7">周日
			</label>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-default" value="提交" />
		</div>
	</form>
  </div>
</body>
</html>