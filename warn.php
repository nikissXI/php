<html>

<?
if (empty($_SESSION['login'])) { ?>
    <B>
        <h2 style="color:red" align="center">请先登录系统</h2>
        <? header("refresh:1;login.php");
        exit;
        ?>
    </B>
<? } ?>

</html>