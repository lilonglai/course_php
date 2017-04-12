<%@ page language="java" contentType="text/html; charset=utf-8"
	pageEncoding="utf-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>增加新老师</title>
<link href="css/bootstrap.css" rel="stylesheet">
<script type="text/javascript">
    function checkForm(){
		if ($("[name='name']").val().length == 0) {
			alert("老师名字不能为空")
			return false;
		}
    	
    	return true;	
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