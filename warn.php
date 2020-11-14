<html>

<?
if (empty($_SESSION['login'])) { ?>
    <B>
        <h2 style="color:red" align="center">гКох╣гб╪о╣мЁ</h2>
        <? header("refresh:1;login.php");
        exit;
        ?>
    </B>
<? } ?>

</html>