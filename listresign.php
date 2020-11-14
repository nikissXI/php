<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>离职员工信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">离职员工信息</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from listresign order by 员工编号";
$sql2 = " where ";

if (isset($_GET['kw'])) {
    $sql = $sql . " where " . $_GET['kw'] . " order by 员工编号";
}
@$result = odbc_exec($conn, $sql);
if (!$result) {
    if (odbc_errormsg($conn) != "[Microsoft][ODBC SQL Server Driver][SQL Server]“where”附近有语法错误。") {
?>
        <B>
            <p style="text-align:center;color:red"><?= odbc_errormsg($conn) ?></p>
        </B>
<? }
    $sql = "select * from listresign order by 员工编号";
    $result = odbc_exec($conn, $sql);
}
?>

<form action="listresign.php" method="get">
    <p align="center" class="where">条件过滤(SQL语句): WHERE
        <input name="kw" type="text" size="100" />
        <input type="submit" name="submit" class="sm" value="提交" /></p>
</form>

<!-- 员工编号,员工姓名,性别,手机号,部门,离职原因,离职日期 -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td>员工编号</td>
        <td width="80">员工姓名</td>
        <td width="80">性别</td>
        <td width="80">手机号</td>
        <td width="80">部门</td>
        <td width="80">离职原因</td>
        <td width="80">离职日期</td>
    </tr>
    <?
    while ($row = odbc_fetch_array($result)) { ?>
        <tr align="center">
            <td><?= $row['员工编号'] ?></td>
            <td><?= $row['员工姓名'] ?></td>
            <td><?= $row['性别'] ?></td>
            <td><?= $row['手机号'] ?></td>
            <td><?= $row['部门'] ?></td>
            <td><?= $row['离职原因'] ?></td>
            <td><?= $row['离职日期'] ?></td>
        </tr>
    <? } ?>
</table>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">返回主菜单</a></td>
    </tr>
</table>

</html>