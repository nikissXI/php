<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>�����Ա��</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">�����Ա��</h2>
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

if (isset($_POST['submit'])) {
    $sql = "exec new @DepartmentID=" . $_POST['DepartmentID'] . ",@Position='" . $_POST['Position'] . "',@BasicWage=" . $_POST['BasicWage'] . ",@PersonnelName='" . $_POST['PersonnelName'] . "',@Sex='" . $_POST['Sex'] . "',@Tel='" . $_POST['Tel'] . "',@Addr='" . $_POST['Addr'] . "',@Marriage='" . $_POST['Marriage'] . "',@Education='" . $_POST['Education'] . "',@PID='" . $_POST['PID'] . "'";
    @$result = odbc_exec($conn, $sql);

    if ($result) { ?>
        <B>
            <h2 style="color:red" align="center">��ӳɹ�!</h2>
        </B>
    <?
        header("refresh:1;listemployment.php");
        exit;
    } else { ?>
        <B>
            <h2 style="color:red" align="center">���ʧ��!</h2>
        </B>
    <?
        header("refresh:1;listemployment.php");
        exit;
    }
} else {
    $sql = "select DepartmentID,DepartmentName from Department";
    $result = odbc_exec($conn, $sql);
    ?>
    <!-- ���ű��,��λ,��������,����,�Ա�,�ֻ�,סַ,����״��,ѧ��,���֤���� -->
    <form action="newemployment" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">����:</td>
                <td>
                    <select name="DepartmentID">
                        <?
                        while ($row = odbc_fetch_array($result)) {
                            echo "<option value=\"" . $row['DepartmentID'] . "\">" . $row['DepartmentName'] . "</option>";
                        } ?>
                    </select></td>
            </tr>
            <tr>
                <td align="right">��λ:</td>
                <td><input type="text" name="Position" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">��������:</td>
                <td><input type="text" name="BasicWage" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">����:</td>
                <td><input type="text" name="PersonnelName" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">�Ա�:</td>
                <td><select name="Sex">
                        <option value="��">��</option>
                        <option value="Ů">Ů</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">�ֻ�:</td>
                <td><input type="text" name="Tel" id="tel" required="required" maxlength="11" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">סַ:</td>
                <td><textarea name="Addr" warp="virtual" required="required"></textarea></td>
            </tr>
            <tr>
                <td align="right">�������:</td>
                <td><select name="Marriage">
                        <option value="δ��">δ��</option>
                        <option value="�ѻ�">�ѻ�</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">ѧ��:</td>
                <td><select name="Education">
                        <option value="����">����</option>
                        <option value="˶ʿ�о���">˶ʿ�о���</option>
                        <option value="��ʿ�о���">��ʿ�о���</option>
                        <option value="ר��">ר��</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">���֤����:</td>
                <td><input type="text" name="PID" id="pid" required="required" maxlength="18" size="28"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="sm" onclick="return check();" name="submit" value="������" /></td>
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