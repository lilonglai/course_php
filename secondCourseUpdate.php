<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ page language="java" contentType="text/html; charset=utf-8"
         pageEncoding="utf-8" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改老师信息</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script>
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

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <form action="secondCourseUpdateSubmit.html" method="get" onSubmit="return checkForm();">
        <input type="hidden" name="id" value="${secondCourse.id}">

        <div class="form-group">
            课程名称: <input type="text" name="name" value="${secondCourse.name}"/>
        </div>
        <div class="form-group">
            课程简称: <input type="text" name="shortName" value="${secondCourse.shortName}"/>
        </div>
        <div class="form-group">
            课程分类: <select name="firstCourseId">

            <c:forEach var="firstCourse2" items="${firstCourseList}">
                <c:if test="${firstCourse2.id == secondCourse.firstCourseId}">
                    <option value="${firstCourse2.id}" selected> ${firstCourse2.name}</option>
                </c:if>
                <c:if test="${firstCourse2.id != secondCourse.firstCourseId}">
                    <option value="${firstCourse2.id}"> ${firstCourse2.name}</option>
                </c:if>
            </c:forEach>
        </select>
        </div>
        <div class="form-group">
            课程描述: <textarea rows="4" cols="25" name="description"> ${secondCourse.description} </textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交" name="submit"/>
        </div>
    </form>

</div>
</body>
</html>