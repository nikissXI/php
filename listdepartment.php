<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>��˾��������Ϣ</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">��˾��������Ϣ</h2>

<?
require("warn.php");
require("sql.php");
$sql = "select * from department order by DepartmentID";
@$result = odbc_exec($conn, $sql);
?>

<form action="detail.php" method="GET">
</form>

<!-- ���ű��,��������,���Ž��� -->
<table border="3" align="center" cellpadding="2">
    <tr align="center">
        <td width="100">���ű��</td>
        <td width="100">��������</td>
        <td>���Ž���</td>
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
            <td><a href="updatedepartment.php?id=<?= $row['DepartmentID'] ?>" style="color:white">����</a></td>
        </tr>
    <? } ?>
</table>
<?
$sql = "select * from listmember order by Ա�����";
for ($i = 0; $i < count($list); $i++) {
    $result = odbc_exec($conn, $sql); ?>
    <br />
    <h2 align="center" style="color:rgb(158, 216, 216);"><?= $list[$i] . "Ա��" ?></h2>
    <table border="3" align="center" cellpadding="2">
        <tr>
            <td align="center" width="100">��������</td>
            <td align="center" width="100">Ա������</td>
            <td align="center" width="100">Ա�����</td>
            <td align="center" width="100">��λ</td>
            <td align="center" width="100">����</td>
            <td align="center" width="60">�Ա�</td>
            <td align="center" width="100">�ֻ���</td>
            <td align="center" width="100">��ְ����</td>
        </tr>
        <? while ($row = odbc_fetch_array($result)) {
            if ($row['��������'] == $list[$i]) { ?>
                </tr>
                <td align="center" width="100"><?= $row['Ա������'] ?></td>
                <td align="center" width="100"><?= $row['��������'] ?></td>
                <td align="center" width="100"><?= $row['Ա�����'] ?></td>
                <td align="center" width="100"><?= $row['��λ'] ?></td>
                <td align="center" width="100"><?= $row['����'] ?></td>
                <td align="center" width="60"><?= $row['�Ա�'] ?></td>
                <td align="center" width="100"><?= $row['�ֻ���'] ?></td>
                <td align="center" width="100"><?= $row['��ְ����'] ?></td>
                </tr>
        <? }
        } ?>
    </table>
<? } ?>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">�������˵�</a></td>
    </tr>
</table>

</html>