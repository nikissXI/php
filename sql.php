<html>

<?
$host = "192.168.137.129";
$username = "nikiss";
$password = "nikisss";
$dsn = "Driver={SQL Server};Server='$host';Database=sqlks"; //sql服务器IP,数据库
$conn = odbc_connect($dsn, $username, $password); //sql账号,密码
?>

</html>