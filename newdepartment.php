<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>增加部门</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">增加部门</h2>

<?
require("warn.php");
require("sql.php");
?>

<?
if (isset($_POST['submit'])) {
    $sql = "insert into Department(DepartmentName,Introduction) values('" . $_POST['DepartmentName'] . "','" . $_POST['Introduction'] . "')";
    @$result = odbc_exec($conn, $sql);

    if ($result) { ?>
        <B>
            <h2 style="color:red" align="center">添加成功!</h2>
        </B>
    <?
        header("refresh:1;listdepartment.php");
        exit;
    } else { ?>
        <B>
            <h2 style="color:red" align="center">添加失败!</h2>
        </B>
    <?
        header("refresh:1;listdepartment.php");
        exit;
    }
} else { ?>
    <!-- 部门名称,介绍 -->
    <form action="newdepartment.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">部门名称:</td>
                <td><input type="text" name="DepartmentName" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">介绍:</td>
                <td><textarea name="Introduction" warp="virtual" required="required"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="sm" name="submit" value="完成添加" /></td>
            </tr>
        </table>
    </form>
<? } ?>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">返回主菜单</a></td>
    </tr>
</table>

</html>