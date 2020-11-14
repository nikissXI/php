<html>
<? session_start();
header("Content-Type: text/html; charset=gb2312"); ?>

<head>
    <title>添加新员工</title>
    <link href="menu.css" type="text/css" rel="stylesheet" />
</head>
<h2 align="center" style="color:rgb(158, 216, 216);">添加新员工</h2>
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

if (isset($_POST['submit'])) {
    $sql = "exec new @DepartmentID=" . $_POST['DepartmentID'] . ",@Position='" . $_POST['Position'] . "',@BasicWage=" . $_POST['BasicWage'] . ",@PersonnelName='" . $_POST['PersonnelName'] . "',@Sex='" . $_POST['Sex'] . "',@Tel='" . $_POST['Tel'] . "',@Addr='" . $_POST['Addr'] . "',@Marriage='" . $_POST['Marriage'] . "',@Education='" . $_POST['Education'] . "',@PID='" . $_POST['PID'] . "'";
    @$result = odbc_exec($conn, $sql);

    if ($result) { ?>
        <B>
            <h2 style="color:red" align="center">添加成功!</h2>
        </B>
    <?
        header("refresh:1;listemployment.php");
        exit;
    } else { ?>
        <B>
            <h2 style="color:red" align="center">添加失败!</h2>
        </B>
    <?
        header("refresh:1;listemployment.php");
        exit;
    }
} else {
    $sql = "select DepartmentID,DepartmentName from Department";
    $result = odbc_exec($conn, $sql);
    ?>
    <!-- 部门编号,岗位,基础工资,姓名,性别,手机,住址,婚姻状况,学历,身份证号码 -->
    <form action="newemployment" method="post">
        <table border="3" align="center" cellpadding="2">
            <tr>
                <td align="right">部门:</td>
                <td>
                    <select name="DepartmentID">
                        <?
                        while ($row = odbc_fetch_array($result)) {
                            echo "<option value=\"" . $row['DepartmentID'] . "\">" . $row['DepartmentName'] . "</option>";
                        } ?>
                    </select></td>
            </tr>
            <tr>
                <td align="right">岗位:</td>
                <td><input type="text" name="Position" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">基础工资:</td>
                <td><input type="text" name="BasicWage" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">姓名:</td>
                <td><input type="text" name="PersonnelName" required="required" size="28"></td>
            </tr>
            <tr>
                <td align="right">性别:</td>
                <td><select name="Sex">
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">手机:</td>
                <td><input type="text" name="Tel" id="tel" required="required" maxlength="11" size="28" oninput="value=value.replace(/[^\d]/g,'')"></td>
            </tr>
            <tr>
                <td align="right">住址:</td>
                <td><textarea name="Addr" warp="virtual" required="required"></textarea></td>
            </tr>
            <tr>
                <td align="right">婚姻情况:</td>
                <td><select name="Marriage">
                        <option value="未婚">未婚</option>
                        <option value="已婚">已婚</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">学历:</td>
                <td><select name="Education">
                        <option value="本科">本科</option>
                        <option value="硕士研究生">硕士研究生</option>
                        <option value="博士研究生">博士研究生</option>
                        <option value="专科">专科</option>
                    </select></td>
            </tr>
            <tr>
                <td align="right">身份证号码:</td>
                <td><input type="text" name="PID" id="pid" required="required" maxlength="18" size="28"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" class="sm" onclick="return check();" name="submit" value="完成添加" /></td>
            </tr>
        </table>
    </form>
<? } ?>

<br />
<table align="center">
    <tr>
        <td><a href="menu.php" style="color:white">返回主菜单</a></td>
    </tr>
</table>

</html>