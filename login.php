<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>系统登录</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>

<?
$warn = "";
if (@$_SESSION['login'] == '1') {
    header("location:menu.php");
} else if (isset($_POST['submit']) && isset($_POST['un'])  && isset($_POST['pw'])) {
    require("sql.php");

    $sql = "select * from logininfo where un like '" . @$_POST['un'] . "'";
    @$result = odbc_exec($conn, $sql);
    if ($result)
        $row = odbc_fetch_array($result);
    if (isset($_POST['submit']) && (empty($_POST['un']) || empty($_POST['pw']))) {
        $warn = "用户名或密码为空";
    } else if ($result && $_POST['un'] == $row['un'] && $_POST['pw'] == $row['pw']) {
        $_SESSION['login'] = '1';
        header("location:menu.php");
    } else {
        $warn = "用户名或密码错误";
    }
}
?>

<div class="login">
    <form action="login.php" method="post">
        <table align="center">
            <tr>
                <td>
                    <h1>&emsp;</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h1 style="text-align:center;color:rgb(158, 216, 216);">&emsp;&emsp;&emsp;人事管理系统后台&emsp;&emsp;&emsp;</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <p>&emsp;</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">用户名: <input name=" un" class="input" type="text" size="20" required="required" class="username" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">密&emsp;码: <input name="pw" class="input" type="password" size="20" required="required" class="pass" /></td>
            </tr>
            <tr>
                <td>
                    <p>&emsp;</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="登陆" class="sm" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <B>
                        <p style="color:red"><?= $warn ?></p>
                    </B>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>&emsp;</h1>
                </td>
            </tr>
        </table>
    </form>
</div>

</html>