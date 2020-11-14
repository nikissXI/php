<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>更新员工工资信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">更新员工工资信息</h2>

<?
require("warn.php");
require("sql.php");
?>

<?
if (isset($_GET['id'])) {
    $sql = "select * from listwage where 员工编号=" . $_GET['id'];
    $result = odbc_exec($conn, $sql);
    if (!$result) {
        header("location:menu.php");
        exit;
    }
    $row = odbc_fetch_array($result);
?>

    <form action="updatewage.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">员工编号:</td>
                <td><?= $row['员工编号'] ?><input type="hidden" name="PersonnelID" value="<?= $row['员工编号'] ?>"></td>
            </tr>
            <tr>
                <td align="right">员工姓名:</td>
                <td><?= $row['员工姓名'] ?></td>
            </tr>
            <tr>
                <td align="right">所属部门:</td>
                <td><?= $row['所属部门'] ?></td>
            </tr>
            <tr>
                <td align="right">基础工资:</td>
                <td><input type="text" name="BasicWage" value="<?= $row['基础工资'] ?>" required="required" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">奖金:</td>
                <td><input type="text" name="AwardMoney" value="<?= $row['奖金'] ?>" required="required" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">罚金:</td>
                <td><input type="text" name="FinedMoney" value="<?= $row['罚金'] ?>" required="required" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">实发工资:</td>
                <td><?= $row['实发工资'] . "(提交后更新)" ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="完成更新" /><br /><?= @$_GET['warn'] ?></td>
            </tr>
        </table>
    </form>
<? }
if (isset($_POST['submit'])) {
    $sql = "exec updatewage @PersonnelID=" . $_POST['PersonnelID'] . ",@BasicWage=" . $_POST['BasicWage'] . ",@AwardMoney=" . $_POST['AwardMoney'] . ",@FinedMoney=" . $_POST['FinedMoney'];
    @$result = odbc_exec($conn, $sql);
    if ($result) {
        header("location:updatewage.php?id=" . $_POST['PersonnelID'] . "&warn=更新成功");
        exit;
    } else {
        header("location:updatewage.php?id=" . $_POST['PersonnelID'] . "&warn=更新失败");
        exit;
    }
}
?>

<br />
<table align="center">
    <tr>
        <td><a href="listwage.php" style="color:white">返回上一级</a></td>
    </tr>
</table>

</html>