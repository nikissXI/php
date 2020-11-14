<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>员工信息详情</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">员工信息详情</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from detail order by 员工编号";
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
    $sql = "select * from detail order by 员工编号";
    $result = odbc_exec($conn, $sql);
}
?>

<form action="listemployment.php" method="get">
    <p align="center" class="where">条件过滤(SQL语句): WHERE
        <input name="kw" type="text" size="100" />
        <input type="submit" name="submit" class="sm" value="提交" /></p>
</form>

<!-- 状态,员工姓名,身份证号码,员工编号,岗位,所属部门,部门编号,工资,性别,手机,住址,婚姻情况,学历 -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td>状态</td>
        <td width="80">员工姓名</td>
        <td>身份证号码</td>
        <td>员工编号</td>
        <td>入职日期</td>
        <td width="100">岗位</td>
        <td width="100">所属部门</td>
        <td>部门编号</td>
        <td width="80">工资</td>
        <td>性别</td>
        <td>手机</td>
        <td width="200">住址</td>
        <td>婚姻情况</td>
        <td width="100">学历</td>
    </tr>
    <?
    while ($row = odbc_fetch_array($result)) { ?>
        <tr align="center">
            <td><?= $row['状态'] ?></td>
            <td><?= $row['员工姓名'] ?></td>
            <td><?= $row['身份证号码'] ?></td>
            <td><?= $row['员工编号'] ?></td>
            <td><?= $row['入职日期'] ?></td>
            <td><?= $row['岗位'] ?></td>
            <td><?= $row['所属部门'] ?></td>
            <td><?= $row['部门编号'] ?></td>
            <td><?= $row['工资'] ?></td>
            <td><?= $row['性别'] ?></td>
            <td><?= $row['手机'] ?></td>
            <td><?= $row['住址'] ?></td>
            <td><?= $row['婚姻情况'] ?></td>
            <td><?= $row['学历'] ?></td>
            <td><a href="updateemployment.php?id=<?= $row['员工编号'] ?>" style="color:white">更新</a></td>
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