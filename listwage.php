<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>员工工资信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">员工工资信息</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from listwage order by 员工编号";
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
    $sql = "select * from listwage order by 员工编号";
    $result = odbc_exec($conn, $sql);
}
?>

<form action="listwage.php" method="get">
    <p align="center" class="where">条件过滤(SQL语句): WHERE
        <input name="kw" type="text" size="100" />
        <input type="submit" name="submit" class="sm" value="提交" /></p>
</form>

<!-- 员工编号,员工姓名,所属部门,基础工资,奖金,罚金,实发工资 -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td>员工编号</td>
        <td width="80">员工姓名</td>
        <td width="80">所属部门</td>
        <td width="80">基础工资</td>
        <td width="80">奖金</td>
        <td width="80">罚金</td>
        <td width="80">实发工资</td>
    </tr>
    <?
    while ($row = odbc_fetch_array($result)) { ?>
        <tr align="center">
            <td><?= $row['员工编号'] ?></td>
            <td><?= $row['员工姓名'] ?></td>
            <td><?= $row['所属部门'] ?></td>
            <td><?= $row['基础工资'] ?></td>
            <td><?= $row['奖金'] ?></td>
            <td><?= $row['罚金'] ?></td>
            <td><?= $row['实发工资'] ?></td>
            <td><a href="updatewage.php?id=<?= $row['员工编号'] ?>" style="color:white">更新</a></td>
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