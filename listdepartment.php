<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>公司各部门信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">公司各部门信息</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from department order by DepartmentID";
@$result = odbc_exec($conn, $sql);
?>

<form action="detail.php" method="GET">
</form>

<!-- 部门编号,部门名称,部门介绍 -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td width="100">部门编号</td>
        <td width="100">部门名称</td>
        <td>部门介绍</td>
    </tr>
    <?
    while ($row = odbc_fetch_array($result)) {
        $list[] = $row['DepartmentName'];
    ?>
        <tr align="center">
            <td><?= $row['DepartmentID'] ?></td>
            <td><?= $row['DepartmentName'] ?></td>
            <td>
                <p><?= $row['Introduction'] ?></p>
            </td>
            <td><a href="updatedepartment.php?id=<?= $row['DepartmentID'] ?>" style="color:white">更新</a></td>
        </tr>
    <? } ?>
</table>
<?
$sql = "select * from listmember order by 员工编号";
for ($i = 0; $i < count($list); $i++) {
    $result = odbc_exec($conn, $sql); ?>
    <br />
    <h2 align="center" style="color:rgb(158, 216, 216);"><?= $list[$i] . "员工" ?></h2>
    <table border="3" align="center" cellpadding="2">
        <tr>
            <td align="center" width="100">所属部门</td>
            <td align="center" width="100">员工姓名</td>
            <td align="center" width="100">员工编号</td>
            <td align="center" width="100">岗位</td>
            <td align="center" width="100">工资</td>
            <td align="center" width="60">性别</td>
            <td align="center" width="100">手机号</td>
            <td align="center" width="100">入职日期</td>
        </tr>
        <? while ($row = odbc_fetch_array($result)) {
            if ($row['所属部门'] == $list[$i]) { ?>
                </tr>
                <td align="center" width="100"><?= $row['员工姓名'] ?></td>
                <td align="center" width="100"><?= $row['所属部门'] ?></td>
                <td align="center" width="100"><?= $row['员工编号'] ?></td>
                <td align="center" width="100"><?= $row['岗位'] ?></td>
                <td align="center" width="100"><?= $row['工资'] ?></td>
                <td align="center" width="60"><?= $row['性别'] ?></td>
                <td align="center" width="100"><?= $row['手机号'] ?></td>
                <td align="center" width="100"><?= $row['入职日期'] ?></td>
                </tr>
        <? }
        } ?>
    </table>
<? } ?>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">返回主菜单</a></td>
    </tr>
</table>

</html>