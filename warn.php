<html>

<?
if (empty($_SESSION['login'])) { ?>
    <B>
        <h2 style="color:red" align="center">���ȵ�¼ϵͳ</h2>
        <? header("refresh:1;login.php");
        exit;
        ?>
    </B>
<? } ?>

</html>