<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>添加离职信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">添加离职信息</h2>
<script>
    function check() {
        var pid = document.getElementById('pid');
        if (pid.value.length < 6) {
            alert("员工编号长度为6位！");
            pid.focus();
            return false;
        }
    }
</script>

<?
require("warn.php");
require("sql.php");
?>

<?
if (isset($_POST['submit'])) {
    $sql = "exec resign @PersonnelID=" . $_POST['PersonnelID'] . ",@ResignReason='" . $_POST['TransReason'] . "'";
    @$result = odbc_exec($conn, $sql);

    if ($result) { ?>
        <B>
            <h2 style="color:red" align="center">添加成功!</h2>
        </B>
    <?
        header("refresh:1;listresign.php");
        exit;
    } else { ?>
        <B>
            <h2 style="color:red" align="center">添加失败!</h2>
        </B>
    <?
        header("refresh:1;listresign.php");
        exit;
    }
} else { ?>
    <!-- 部门名称,介绍 -->
    <form action="newresign.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">员工编号:</td>
                <td><input type="text" name="PersonnelID" id="pid" required="required" maxlength="6" size="28"></td>
            </tr>
            <tr>
                <td align="right">离职原因:</td>
                <td><textarea name="TransReason" warp="virtual" required="required"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="sm" name="submit" onclick="return check();" value="完成添加" /></td>
            </tr>
        </table>
    </form>
<? } ?>


<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">返回主菜单</a></td>
    </tr>
</table>
<br />
<div>
    <form action="newresign.php" method="get">
        <p align="center" class="search">员工编号搜索
            <input name="kw" type="text" size="20" placeholder="输入员工姓名" />
            <input type="submit" name="submit" class="sm" value="提交" /></p>
    </form>
</div>

<?
$sql = "select 状态,员工姓名,员工编号 from detail order by 员工编号";

if (isset($_GET['kw'])) {
    $sql = "select 状态,员工姓名,员工编号 from detail where 员工姓名 like '%" . $_GET['kw'] . "%' order by 员工编号";
}
@$result = odbc_exec($conn, $sql);
?>

<div class="list">
    <table border="3" align="center" cellpadding="2">
        <tr align="center">
            <td width="80">员工姓名</td>
            <td>员工编号</td>
        </tr>
        <?
        while ($row = odbc_fetch_array($result)) { ?>
            <tr align="center">
                <td><?= $row['员工姓名'] ?></td>
                <td><?= $row['员工编号'] ?></td>
            </tr>
        <? } ?>
    </table>
</div>

</html>