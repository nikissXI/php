<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>����Ա��������Ϣ</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">����Ա��������Ϣ</h2>

<?
require("warn.php");
require("sql.php");
?>

<?
if (isset($_GET['id'])) {
    $sql = "select * from listwage where Ա�����=" . $_GET['id'];
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
                <td align="right">Ա�����:</td>
                <td><?= $row['Ա�����'] ?><input type="hidden" name="PersonnelID" value="<?= $row['Ա�����'] ?>"></td>
            </tr>
            <tr>
                <td align="right">Ա������:</td>
                <td><?= $row['Ա������'] ?></td>
            </tr>
            <tr>
                <td align="right">��������:</td>
                <td><?= $row['��������'] ?></td>
            </tr>
            <tr>
                <td align="right">��������:</td>
                <td><input type="text" name="BasicWage" value="<?= $row['��������'] ?>" required="required" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">����:</td>
                <td><input type="text" name="AwardMoney" value="<?= $row['����'] ?>" required="required" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">����:</td>
                <td><input type="text" name="FinedMoney" value="<?= $row['����'] ?>" required="required" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">ʵ������:</td>
                <td><?= $row['ʵ������'] . "(�ύ�����)" ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="��ɸ���" /><br /><?= @$_GET['warn'] ?></td>
            </tr>
        </table>
    </form>
<? }
if (isset($_POST['submit'])) {
    $sql = "exec updatewage @PersonnelID=" . $_POST['PersonnelID'] . ",@BasicWage=" . $_POST['BasicWage'] . ",@AwardMoney=" . $_POST['AwardMoney'] . ",@FinedMoney=" . $_POST['FinedMoney'];
    @$result = odbc_exec($conn, $sql);
    if ($result) {
        header("location:updatewage.php?id=" . $_POST['PersonnelID'] . "&warn=���³ɹ�");
        exit;
    } else {
        header("location:updatewage.php?id=" . $_POST['PersonnelID'] . "&warn=����ʧ��");
        exit;
    }
}
?>

<br />
<table align="center">
    <tr>
        <td><a href="listwage.php" style="color:white">������һ��</a></td>
    </tr>
</table>

</html>