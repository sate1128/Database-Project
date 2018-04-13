<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

$sql = "INSERT INTO `account` (account, password ) VALUES(?, ?)";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['account'],$_POST['password']));
?>


