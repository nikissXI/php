<html>

<body class="menu">
    <? session_start();
    header("Content-Type: text/html; charset=gb2312"); ?>

    <head>
        <title>主菜单</title>
        <link href="menu.css" type="text/css" rel="stylesheet" />
    </head>
    <h1 align="center" style="color:rgb(158, 216, 216);">主菜单</h1>

    <script>
        function check() {
            var pw = document.getElementById('pw');
            if (pw.value.length < 6) {
                alert("长度至少6位！");
                pw.focus();
                return false;
            }
        }
    </script>

    <?
    require("warn.php");
    require("sql.php");

    if (isset($_GET['pw'])) {
        $sql = "update logininfo set pw='" . $_GET['pw'] . "'";
        @$result = odbc_exec($conn, $sql);
        if ($result)
            $warn = "更新成功";
        else
            $warn = "更新失败";
    }
    ?>

    <table border="3" align="center" cellpadding="2">
        <tr align="center">
            <td width="200" rowspan="2"> <B>员工管理</B></td>
            <td width="300" height="35"><a href="newemployment.php" style="color:white">添加新员工</a></td>
        </tr>
        <tr align="center">
            <td height="35"><a href="listemployment.php" style="color:white">列出/修改员工信息</a></td>
        </tr>

        <td colspan="2"></td>

        <tr align="center">
            <td rowspan="2"><B>部门管理</B></td>
            <td height="35"><a href="newdepartment.php" style="color:white">添加新部门</a></td>
        </tr>
        <tr align="center">
            <td height="35"><a href="listdepartment.php" style="color:white">列出/修改各部门信息</a></td>
        </tr>

        <td colspan="2"></td>

        <tr align="center" height="50">
            <td><B>工资管理</B></td>
            <td height="35"><a href="listwage.php" style="color:white">列出/修改员工工资信息</a></td>
        </tr>

        <td colspan="2"></td>

        <tr align="center">
            <td rowspan="2"><B>转岗管理</B></td>
            <td height="35"><a href="newtrans.php" style="color:white">添加转岗信息</a></td>
        </tr>
        <tr align="center">
            <td height="35"><a href="listtrans.php" style="color:white">转岗信息查询</a></td>
        </tr>

        <td colspan="2"></td>

        <tr align="center">
            <td rowspan="2"><B>离职管理</B></td>
            <td height="35"><a href="newresign.php" style="color:white">添加离职信息</a></td>
        </tr>
        <tr align="center">
            <td height="35"><a href="listresign.php" style="color:white">离职员工信息查询</a></td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td>
                <form action="menu.php" method="get">
                    <B>更新密码:</B>
                    <input name="pw" id="pw" type="password" size="20" placeholder="密码长度不少于6位" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><? if (isset($warn)) echo $warn . "<br/>"; ?>
                <input type="submit" name="submit" class="sm" onclick="return check();" value="提交" />
            </td>
        </tr>
        </form>
    </table>

    <br />
    <table align="center">
        <tr>
            <td><B><a href="./logout.php?cmd='1'" style="color:white">退出系统</a></B></td>
        </tr>
    </table>
</body>

</html>