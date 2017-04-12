<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ page language="java" contentType="text/html; charset=utf-8"
         pageEncoding="utf-8" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改老师信息</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript">
        function checkForm() {
            if ($("[name='name']").val().length == 0) {
                alert("老师名字不能为空")
                return false;
            }

            return true;

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <form action="teacherUpdateSubmit.html" method="get" onSubmit="return checkForm();">
        <input type="hidden" name="id" value="${teacher.id}">

        <div class="form-group">
            名称: <input type="text" class="form-control" name="name" value="${teacher.name}"/>
        </div>
        <div class="form-group">
            简称: <input type="text" class="form-control" name="shortName" value="${teacher.shortName}"/>
        </div>
        <div class="form-group">
            电话: <input type="text" class="form-control" name="phone" value="${teacher.phone}"/>
        </div>
        <div class="form-group">
            <c:if test="${teacher.isMaster == true}">
                班主任: <input type="checkbox" name="isMaster" checked/> <br>
            </c:if>
            <c:if test="${teacher.isMaster == false}">
                班主任: <input type="checkbox" name="isMaster"/> <br>
            </c:if>
        </div>
        <div class="form-group">
            默认休假情况:<br> &nbsp;&nbsp;


            <c:if test="${teacherDefaultHoliday != null}">
                <input type="hidden" name="id2" value="${teacherDefaultHoliday.id}">
                <c:if test="${teacherDefaultHoliday.week1 == true}">
                    周一 <input type="checkbox" name="weeks" value="week1" checked> &nbsp;
                </c:if>
                <c:if test="${teacherDefaultHoliday.week1 == false}">
                    周一 <input type="checkbox" name="weeks" value="week1"> &nbsp;
                </c:if>

                <c:if test="${teacherDefaultHoliday.week2 == true}">
                    周二 <input type="checkbox" name="weeks" value="week2" checked> &nbsp;
                </c:if>
                <c:if test="${teacherDefaultHoliday.week2 == false}">
                    周二 <input type="checkbox" name="weeks" value="week2"> &nbsp;
                </c:if>

                <c:if test="${teacherDefaultHoliday.week3 == true}">
                    周三 <input type="checkbox" name="weeks" value="week3" checked> &nbsp;
                </c:if>
                <c:if test="${teacherDefaultHoliday.week3 == false}">
                    周三 <input type="checkbox" name="weeks" value="week3"> &nbsp;
                </c:if>

                <c:if test="${teacherDefaultHoliday.week4 == true}">
                    周四 <input type="checkbox" name="weeks" value="week4" checked> &nbsp;
                </c:if>
                <c:if test="${teacherDefaultHoliday.week4 == false}">
                    周四 <input type="checkbox" name="weeks" value="week4"> &nbsp;
                </c:if>

                <c:if test="${teacherDefaultHoliday.week5 == true}">
                    周五 <input type="checkbox" name="weeks" value="week5" checked> &nbsp;
                </c:if>
                <c:if test="${teacherDefaultHoliday.week5 == false}">
                    周五 <input type="checkbox" name="weeks" value="week5"> &nbsp;
                </c:if>

                <c:if test="${teacherDefaultHoliday.week6 == true}">
                    周六 <input type="checkbox" name="weeks" value="week6" checked> &nbsp;
                </c:if>
                <c:if test="${teacherDefaultHoliday.week6 == false}">
                    周六 <input type="checkbox" name="weeks" value="week6"> &nbsp;
                </c:if>

                <c:if test="${teacherDefaultHoliday.week7 == true}">
                    周日 <input type="checkbox" name="weeks" value="week7" checked>
                </c:if>
                <c:if test="${teacherDefaultHoliday.week7 == false}">
                    周日 <input type="checkbox" name="weeks" value="week7">
                </c:if>

            </c:if>

            <c:if test="${teacherDefaultHoliday == null}">
                周一 <input type="checkbox" name="weeks" value="week1"> &nbsp;
                周二 <input type="checkbox" name="weeks" value="week2"> &nbsp;
                周三 <input type="checkbox" name="weeks" value="week3"> &nbsp;
                周四 <input type="checkbox" name="weeks" value="week4"> &nbsp;
                周五 <input type="checkbox" name="weeks" value="week5"> &nbsp;
                周六 <input type="checkbox" name="weeks" value="week6"> &nbsp;
                周日 <input type="checkbox" name="weeks" value="week7">
            </c:if>

        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交"/>
        </div>
    </form>

</div>
</body>
</html>