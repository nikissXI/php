<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>退出</title>
</head>

<? require("warn.php");
require("sql.php"); ?>

<?
if (isset($_GET['cmd'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
}
?>

</html>