<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>Ա��������Ϣ</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">Ա��������Ϣ</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from listwage order by Ա�����";
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
    $sql = "select * from listwage order by Ա�����";
    $result = odbc_exec($conn, $sql);
}
?>

<form action="listwage.php" method="get">
    <p align="center" class="where">��������(SQL���): WHERE
        <input name="kw" type="text" size="100" />
        <input type="submit" name="submit" class="sm" value="�ύ" /></p>
</form>

<!-- Ա�����,Ա������,��������,��������,����,����,ʵ������ -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td>Ա�����</td>
        <td width="80">Ա������</td>
        <td width="80">��������</td>
        <td width="80">��������</td>
        <td width="80">����</td>
        <td width="80">����</td>
        <td width="80">ʵ������</td>
    </tr>
    <?
    while ($row = odbc_fetch_array($result)) { ?>
        <tr align="center">
            <td><?= $row['Ա�����'] ?></td>
            <td><?= $row['Ա������'] ?></td>
            <td><?= $row['��������'] ?></td>
            <td><?= $row['��������'] ?></td>
            <td><?= $row['����'] ?></td>
            <td><?= $row['����'] ?></td>
            <td><?= $row['ʵ������'] ?></td>
            <td><a href="updatewage.php?id=<?= $row['Ա�����'] ?>" style="color:white">����</a></td>
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