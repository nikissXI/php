<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>更新部门信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">更新部门信息</h2>

<?
require("warn.php");
require("sql.php");
?>

<?
if (isset($_GET['id'])) {
    $sql = "select * from Department where DepartmentID=" . $_GET['id'];
    $result = odbc_exec($conn, $sql);
    if (!$result) {
        header("location:menu.php");
        exit;
    }
    $row = odbc_fetch_array($result);
?>
    <!-- DepartmentID,DepartmentName,Introduction -->
    <form action="updatedepartment.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">部门编号:</td>
                <td><?= $row['DepartmentID'] ?><input type="hidden" name="DepartmentID" value="<?= $row['DepartmentID'] ?>"></td>
            </tr>
            <tr>
                <td align="right">部门名称:</td>
                <td><input type="text" name="DepartmentName" value="<?= $row['DepartmentName'] ?>" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">部门介绍:</td>
                <td>
                    <p><textarea name="Introduction" warp="virtual" required="required"><?= $row['Introduction'] ?></textarea></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="完成更新" /><br /><?= @$_GET['warn'] ?></td>
            </tr>
        </table>
    </form>
<? }
if (isset($_POST['submit'])) {
    $sql = "update Department set DepartmentName='" . $_POST['DepartmentName'] . "',Introduction='" . $_POST['Introduction'] . "' where DepartmentID=" . $_POST['DepartmentID'];
    @$result = odbc_exec($conn, $sql);
    if ($result) {
        header("location:updatedepartment.php?id=" . $_POST['DepartmentID'] . "&warn=更新成功");
        exit;
    } else {
        header("location:listdepartment.php?id=" . $_POST['DepartmentID'] . "&warn=更新失败");
        exit;
    }
}
?>

<br />
<table align="center">
    <tr>
        <td><a href="listdepartment.php" style="color:white">返回上一级</a></td>
    </tr>
</table>

</html>