<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>����Ա����Ϣ</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">����Ա����Ϣ</h2>
<script>
    function check() {
        var tel = document.getElementById('tel');
        if (tel.value.length < 11) {
            alert("�ֻ��ų���Ϊ11λ��");
            tel.focus();
            return false;
        }
        var pid = document.getElementById('pid');
        if (pid.value.length < 18) {
            alert("���֤����Ϊ18λ��");
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
if (isset($_GET['id'])) {
    $sql = "select * from Employment where PersonnelID=" . $_GET['id'];
    $result = odbc_exec($conn, $sql);
    if (!$result) {
        header("location:menu.php");
        exit;
    }
    $row = odbc_fetch_array($result);
?>
    <!-- PersonnelID,PersonnelName,Sex,Tel,Addr,Marriage,Education,PID -->
    <form action="updateemployment.php" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">Ա�����:</td>
                <td><?= $row['PersonnelID'] ?><input type="hidden" name="PersonnelID" value="<?= $row['PersonnelID'] ?>"></td>
            </tr>
            <tr>
                <td align="right">Ա������:</td>
                <td><input type="text" name="PersonnelName" value="<?= $row['PersonnelName'] ?>" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">�Ա�:</td>
                <td><select name="Sex">
                        <option value="��" <? if ($row['Sex'] == '��') echo 'selected="selected"'; ?>>��</option>
                        <option value="Ů" <? if ($row['Sex'] == 'Ů') echo 'selected="selected"'; ?>>Ů</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">�ֻ�:</td>
                <td><input type="text" name="Tel" id="tel" value="<?= $row['Tel'] ?>" required="required" maxlength="11" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">סַ:</td>
                <td><textarea name="Addr" warp="virtual" required="required"><?= $row['Addr'] ?></textarea></td>
            </tr>
            <tr>
                <td align="right">�������:</td>
                <td><select name="Marriage">
                        <option value="δ��" <? if ($row['Marriage'] == 'δ��') echo 'selected="selected"'; ?>>δ��</option>
                        <option value="�ѻ�" <? if ($row['Marriage'] == '�ѻ�') echo 'selected="selected"'; ?>>�ѻ�</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">ѧ��:</td>
                <td><select name="Education">
                        <option value="����" <? if ($row['Education'] == '����') echo 'selected="selected"'; ?>>����</option>
                        <option value="˶ʿ�о���" <? if ($row['Education'] == '˶ʿ�о���') echo 'selected="selected"'; ?>>˶ʿ�о���</option>
                        <option value="��ʿ�о���" <? if ($row['Education'] == '��ʿ�о���') echo 'selected="selected"'; ?>>��ʿ�о���</option>
                        <option value="ר��" <? if ($row['Education'] == 'ר��') echo 'selected="selected"'; ?>>ר��</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">���֤����:</td>
                <td><input type="text" name="PID" id="pid" value="<?= $row['PID'] ?>" required="required" maxlength="18" size="28"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" onclick="return check();" value="��ɸ���" /><br /><?= @$_GET['warn'] ?></td>
            </tr>
        </table>
    </form>
<? }
if (isset($_POST['submit'])) {
    $sql = "UPDATE Employment SET PersonnelName='" . $_POST['PersonnelName'] . "',Sex='" . $_POST['Sex'] . "',Tel=" . $_POST['Tel'] . ",Addr='" . $_POST['Addr'] . "',Marriage='" . $_POST['Marriage'] . "',Education='" . $_POST['Education'] . "',PID='" . $_POST['PID'] . "' WHERE PersonnelID=" . $_POST['PersonnelID'];
    @$result = odbc_exec($conn, $sql);
    if ($result) {
        header("location:updateemployment.php?id=" . $_POST['PersonnelID'] . "&warn=���³ɹ�");
        exit;
    } else {
        header("location:updateemployment.php?id=" . $_POST['PersonnelID'] . "&warn=����ʧ��");
        exit;
    }
}
?>

<br />
<table align="center">
    <tr>
        <td><a href="listemployment.php" style="color:white">������һ��</a></td>
    </tr>
</table>

</html>