<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>�����ְ��Ϣ</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">�����ְ��Ϣ</h2>
<script>
    function check() {
        var pid = document.getElementById('pid');
        if (pid.value.length < 6) {
            alert("Ա����ų���Ϊ6λ��");
            pid.focus();
            return false;
        }
    }
</script>

<?
require("warn.php");
require("sql.php");
?>

<?
if (isset($_POST['submit'])) {
    $sql = "exec resign @PersonnelID=" . $_POST['PersonnelID'] . ",@ResignReason='" . $_POST['TransReason'] . "'";
    @$result = odbc_exec($conn, $sql);

    if ($result) { ?>
        <B>
            <h2 style="color:red" align="center">��ӳɹ�!</h2>
        </B>
    <?
        header("refresh:1;listresign.php");
        exit;
    } else { ?>
        <B>
            <h2 style="color:red" align="center">���ʧ��!</h2>
        </B>
    <?
        header("refresh:1;listresign.php");
        exit;
    }
} else { ?>
    <!-- ��������,���� -->
    <form action="newresign.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">Ա�����:</td>
                <td><input type="text" name="PersonnelID" id="pid" required="required" maxlength="6" size="28"></td>
            </tr>
            <tr>
                <td align="right">��ְԭ��:</td>
                <td><textarea name="TransReason" warp="virtual" required="required"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="sm" name="submit" onclick="return check();" value="������" /></td>
            </tr>
        </table>
    </form>
<? } ?>


<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">�������˵�</a></td>
    </tr>
</table>
<br />
<div>
    <form action="newresign.php" method="get">
        <p align="center" class="search">Ա���������
            <input name="kw" type="text" size="20" placeholder="����Ա������" />
            <input type="submit" name="submit" class="sm" value="�ύ" /></p>
    </form>
</div>

<?
$sql = "select ״̬,Ա������,Ա����� from detail order by Ա�����";

if (isset($_GET['kw'])) {
    $sql = "select ״̬,Ա������,Ա����� from detail where Ա������ like '%" . $_GET['kw'] . "%' order by Ա�����";
}
@$result = odbc_exec($conn, $sql);
?>

<div class="list">
    <table border="3" align="center" cellpadding="2">
        <tr align="center">
            <td width="80">Ա������</td>
            <td>Ա�����</td>
        </tr>
        <?
        while ($row = odbc_fetch_array($result)) { ?>
            <tr align="center">
                <td><?= $row['Ա������'] ?></td>
                <td><?= $row['Ա�����'] ?></td>
            </tr>
        <? } ?>
    </table>
</div>

</html>