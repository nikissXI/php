<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>���Ӳ���</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">���Ӳ���</h2>

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
            <h2 style="color:red" align="center">��ӳɹ�!</h2>
        </B>
    <?
        header("refresh:1;listdepartment.php");
        exit;
    } else { ?>
        <B>
            <h2 style="color:red" align="center">���ʧ��!</h2>
        </B>
    <?
        header("refresh:1;listdepartment.php");
        exit;
    }
} else { ?>
    <!-- ��������,���� -->
    <form action="newdepartment.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">��������:</td>
                <td><input type="text" name="DepartmentName" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">����:</td>
                <td><textarea name="Introduction" warp="virtual" required="required"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="sm" name="submit" value="������" /></td>
            </tr>
        </table>
    </form>
<? } ?>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">�������˵�</a></td>
    </tr>
</table>

</html>