<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>ת����Ϣ</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">ת����Ϣ</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from listtrans order by Ա�����";
$sql2 = " where ";

if (isset($_GET['kw'])) {
    $sql = $sql . " where " . $_GET['kw'] . " order by Ա�����";
}
@$result = odbc_exec($conn, $sql);
if (!$result) {
    if (odbc_errormsg($conn) != "[Microsoft][ODBC SQL Server Driver][SQL Server]��where���������﷨����") {
?>
        <B>
            <p style="text-align:center;color:red"><?= odbc_errormsg($conn) ?></p>
        </B>
<? }
    $sql = "select * from listtrans order by Ա�����";
    $result = odbc_exec($conn, $sql);
}
?>

<form action="listtrans.php" method="get">
    <p align="center" class="where">��������(SQL���): WHERE
        <input name="kw" type="text" size="100" />
        <input type="submit" name="submit" class="sm" value="�ύ" /></p>
</form>

<!-- Ա�����,Ա������,ת������,ת��ԭ��,�²���,�¸�λ,�ɲ���,�ɸ�λ -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td>Ա�����</td>
        <td width="80">Ա������</td>
        <td width="80">ת������</td>
        <td width="80">ת��ԭ��</td>
        <td width="80">�²���</td>
        <td width="80">�¸�λ</td>
        <td width="80">�ɲ���</td>
        <td width="80">�ɸ�λ</td>
    </tr>
    <?
    while ($row = odbc_fetch_array($result)) { ?>
        <tr align="center">
            <td><?= $row['Ա�����'] ?></td>
            <td><?= $row['Ա������'] ?></td>
            <td><?= $row['ת������'] ?></td>
            <td><?= $row['ת��ԭ��'] ?></td>
            <td><?= $row['�²���'] ?></td>
            <td><?= $row['�¸�λ'] ?></td>
            <td><?= $row['�ɲ���'] ?></td>
            <td><?= $row['�ɸ�λ'] ?></td>
        </tr>
    <? } ?>
</table>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">�������˵�</a></td>
    </tr>
</table>

</html>