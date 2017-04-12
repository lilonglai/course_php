<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ page language="java" contentType="text/html; charset=utf-8"
         pageEncoding="utf-8" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>老师能力信息</title>
    <link href="css/bootstrap.css" rel="stylesheet">

    <script language="JavaScript">
        function copyToList(from, to) {
            fromList = eval('document.abilityForm.' + from);
            toList = eval('document.abilityForm.' + to);
            if (toList.options.length > 0 && toList.options[0].value == 'temp') {
                toList.options.length = 0;
            }
            var sel = false;
            for (i = 0; i < fromList.options.length; i++) {
                var current = fromList.options[i];
                if (current.selected) {
                    sel = true;
                    txt = current.text;
                    val = current.value;
                    toList.options[toList.length] = new Option(txt, val);
                    fromList.options[i] = null;
                    i--;
                }
            }
            if (!sel)
                alert('你还没有选择任何项目');
        }

        function allSelect() {
            List = document.abilityForm.chosen;
            for (i = 0; i < List.length; i++) {
                List.options[i].selected = true;
            }
        }

        function gradeChanged() {
            //alert(document.abilityForm);
            //document.abilityForm.submit();
            var form = document.getElementById("abilityForm");
            form.submit();
        }
    </script>

</head>
<body>


<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">排课系统</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./teacher.html">老师信息</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
</div>

<div class="container">
    老师:${teacher.name}<br>

    <h2>目前能力情况</h2>
    <br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>年级</th>
                <th>课程名称</th>
                <th>课程简称</th>
            </tr>
            </thead>
            <tbody>
            <c:forEach var="firstCourse" items="${allFirstCourseList}">
                <tr>
                    <td>${firstCourse.grade}</td>
                    <td>${firstCourse.name}</td>
                    <td>${firstCourse.shortName}</td>
                </tr>
            </c:forEach>

            </tbody>
        </table>
    </div>

    <br>

    <h2> 修改能力</h2>

    <form action="teacherAbilitySubmit.html" method="get" name="abilityForm" id="abilityForm" onSubmit="allSelect();">
        <input type="hidden" name="id" value="${teacher.id}">

        <div class="form-group">
            选择年级: <select name="grade" onChange="gradeChanged();">
            <c:if test="${grade == 1}">
                <option value="1" selected>4-6</option>
            </c:if>
            <c:if test="${grade != 1}">
                <option value="1">4-6</option>
            </c:if>

            <c:if test="${grade == 2}">
                <option value="2" selected>7-9</option>
            </c:if>
            <c:if test="${grade != 2}">
                <option value="2">7-9</option>
            </c:if>

            <c:if test="${grade == 3}">
                <option value="3" selected>10-12</option>
            </c:if>
            <c:if test="${grade != 3}">
                <option value="3">10-12</option>
            </c:if>
        </select>
        </div>

        <div class="form-group">
            <table border="0">
                <tr>
                    <td><select name="possible" size="25" MULTIPLE width=200 style="width: 200px">
                        <c:forEach var="firstCourse" items="${firstCourseList}">
                            <option value="${firstCourse.id}"> ${firstCourse.name} </option>
                        </c:forEach>
                    </select></td>

                    <td><input type="button" value='>>'
                               onclick="copyToList('possible','chosen')"> <br>
                        <br> <input type="button" value='<<' onclick="copyToList('chosen','possible')">
                    </td>

                    <td><select name="chosen" size="25" MULTIPLE width=200 style="width: 200px;">

                        <c:forEach var="firstCourse" items="${selectedFirstCourseList}">
                            <option value="${firstCourse.id}"> ${firstCourse.name} </option>
                        </c:forEach>
                    </select></td>
                </tr>
            </table>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="提交">
        </div>
    </form>

    <br>
    <br>
</div>

</body>
</html>