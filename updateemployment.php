<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>更新员工信息</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">更新员工信息</h2>
<script>
    function check() {
        var tel = document.getElementById('tel');
        if (tel.value.length < 11) {
            alert("手机号长度为11位！");
            tel.focus();
            return false;
        }
        var pid = document.getElementById('pid');
        if (pid.value.length < 18) {
            alert("身份证长度为18位！");
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
                <td align="right">员工编号:</td>
                <td><?= $row['PersonnelID'] ?><input type="hidden" name="PersonnelID" value="<?= $row['PersonnelID'] ?>"></td>
            </tr>
            <tr>
                <td align="right">员工姓名:</td>
                <td><input type="text" name="PersonnelName" value="<?= $row['PersonnelName'] ?>" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">性别:</td>
                <td><select name="Sex">
                        <option value="男" <? if ($row['Sex'] == '男') echo 'selected="selected"'; ?>>男</option>
                        <option value="女" <? if ($row['Sex'] == '女') echo 'selected="selected"'; ?>>女</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">手机:</td>
                <td><input type="text" name="Tel" id="tel" value="<?= $row['Tel'] ?>" required="required" maxlength="11" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">住址:</td>
                <td><textarea name="Addr" warp="virtual" required="required"><?= $row['Addr'] ?></textarea></td>
            </tr>
            <tr>
                <td align="right">婚姻情况:</td>
                <td><select name="Marriage">
                        <option value="未婚" <? if ($row['Marriage'] == '未婚') echo 'selected="selected"'; ?>>未婚</option>
                        <option value="已婚" <? if ($row['Marriage'] == '已婚') echo 'selected="selected"'; ?>>已婚</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">学历:</td>
                <td><select name="Education">
                        <option value="本科" <? if ($row['Education'] == '本科') echo 'selected="selected"'; ?>>本科</option>
                        <option value="硕士研究生" <? if ($row['Education'] == '硕士研究生') echo 'selected="selected"'; ?>>硕士研究生</option>
                        <option value="博士研究生" <? if ($row['Education'] == '博士研究生') echo 'selected="selected"'; ?>>博士研究生</option>
                        <option value="专科" <? if ($row['Education'] == '专科') echo 'selected="selected"'; ?>>专科</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">身份证号码:</td>
                <td><input type="text" name="PID" id="pid" value="<?= $row['PID'] ?>" required="required" maxlength="18" size="28"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" onclick="return check();" value="完成更新" /><br /><?= @$_GET['warn'] ?></td>
            </tr>
        </table>
    </form>
<? }
if (isset($_POST['submit'])) {
    $sql = "UPDATE Employment SET PersonnelName='" . $_POST['PersonnelName'] . "',Sex='" . $_POST['Sex'] . "',Tel=" . $_POST['Tel'] . ",Addr='" . $_POST['Addr'] . "',Marriage='" . $_POST['Marriage'] . "',Education='" . $_POST['Education'] . "',PID='" . $_POST['PID'] . "' WHERE PersonnelID=" . $_POST['PersonnelID'];
    @$result = odbc_exec($conn, $sql);
    if ($result) {
        header("location:updateemployment.php?id=" . $_POST['PersonnelID'] . "&warn=更新成功");
        exit;
    } else {
        header("location:updateemployment.php?id=" . $_POST['PersonnelID'] . "&warn=更新失败");
        exit;
    }
}
?>

<br />
<table align="center">
    <tr>
        <td><a href="listemployment.php" style="color:white">返回上一级</a></td>
    </tr>
</table>

</html>