<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

$theid = $_POST['nowid'];
//echo $theid;
$sql = "DELETE FROM `huangsh1128_cs`.`favorite` WHERE `favorite`.`recruit_id`='$theid'";
if($result=$db->prepare($sql))
{
	$result->execute();
    ?><script>alert ("Delete successful!")</script> <?php
    echo '<meta http-equiv=REFRESH CONTENT=2;url=favorite.php>';
}
else
{
    ?><script>alert ("Delete failed!")</script> <?php
    echo '<meta http-equiv=REFRESH CONTENT=2;url=favorite.php>';
}

?>