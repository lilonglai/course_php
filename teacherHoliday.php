<%@ page language="java" contentType="text/html; charset=utf-8"
         pageEncoding="utf-8" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>调整修改</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/Calendar3.js">
    </script>

</head>
<body>

<div class="container">
    老师:${teacher.name} &nbsp;休假情况<br><br>

    日期:${lastCalendar.get(Calendar.YEAR)}.${lastCalendar.get(Calendar.MONTH)+1}<br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>周一</th>
                <th>周二</th>
                <th>周三</th>
                <th>周四</th>
                <th>周五</th>
                <th>周六</th>
                <th>周日</th>
            </tr>
            </thead>
            <tbody>
            ${lastMonthHoliday}
            </tbody>
        </table>
    </div>

    日期:${thisCalendar.get(Calendar.YEAR)}.${thisCalendar.get(Calendar.MONTH)+2}<br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>周一</th>
                <th>周二</th>
                <th>周三</th>
                <th>周四</th>
                <th>周五</th>
                <th>周六</th>
                <th>周日</th>
            </tr>
            </thead>
            <tbody>

            ${thisMonthHoliday}
            </tbody>
        </table>
    </div>


    <br>

    日期:${nextCalendar.get(Calendar.YEAR)}.${nextCalendar.get(Calendar.MONTH)+3}<br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>周一</th>
                <th>周二</th>
                <th>周三</th>
                <th>周四</th>
                <th>周五</th>
                <th>周六</th>
                <th>周日</th>
            </tr>
            </thead>
            <tbody>
            ${nextMonthHoliday}
            </tbody>
        </table>
    </div>

    <br>
    <br>
    修改休假时间:<br>

    <form action="teacherHoliday.jsp" method="get">
        <input type="hidden" name="id" value="${teacher.id}">
        <span>选择日期：</span> <span>
                    <input name="control_date" type="text" id="control_date" size="10"
                           maxlength="10" onclick="new Calendar().show(this);" readonly="readonly"/>
                    </span>
        <br>
        选择类型:
        <input type="radio" name="setHoliday" value="true"> 休假
        <input type="radio" name="setHoliday" value="false" checked> 上班<br>
        <input type="submit" class="btn btn-default" value="提交" name="submit">
    </form>
</div>
</body>
</html>