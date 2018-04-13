<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['id']);
?>	<script>alert ("Logouting......")</script> <?php
echo '<meta http-equiv=REFRESH CONTENT=1;url=login2.php>';
?>