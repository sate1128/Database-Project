<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

$job=$_POST['job'];			

$sle = "SELECT * FROM `occupation`";
$sth = $db->prepare($sle);
$sth->execute();
while($result=$sth->fetchObject())
{
	if($result->occupation==$job)
	{
		$occupation_id=$result->id;
	}
}
$location=$_POST['location'];			

$sle3 = "SELECT * FROM `location`";
$sth3 = $db->prepare($sle3);
$sth3->execute();
while($result3=$sth3->fetchObject())
{
	if($result3->location==$location)
	{
		$location_id=$result3->id;
	}
}


$time=$_POST['time'];
$edu=$_POST['edu'];
$experience=$_POST['experience'];
$salary=$_POST['salary'];
$id=$_SESSION['id'];

$sle4 = "SELECT * FROM `employer`";
$sth4 = $db->prepare($sle4);
$sth4->execute();

$sql = "INSERT INTO `huangsh1128_cs`.`recruit` (id, employer_id, occupation_id, location_id, working_time, education, experience, salary) VALUES (?,?,?,?,?,?,?,?)";

if($inserert_2 = $db->prepare($sql))
{
	$inserert_2->execute(array(NULL, $id, $occupation_id, $location_id, $time, $edu, $experience, $salary));
    ?><script>alert ("Add successful!")</script> <?php
    echo '<meta http-equiv=REFRESH CONTENT=2;url=manage.php>';
}
else
{
    ?><script>alert ("Add failed!")</script> <?php
    echo '<meta http-equiv=REFRESH CONTENT=2;url=manage.php>';
}

?>