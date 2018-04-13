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
$sq2 = "INSERT INTO `huangsh1128_cs`.`occupation` (id, occupation) VALUES (?,?)";
$ins2 = $db->prepare($sq2);
$ins2->execute(array(NULL,$job));
$sle2 = "SELECT * FROM `occupation`";
$sth2 = $db->prepare($sle2);
$sth2->execute();
while($result2=$sth2->fetchObject())
{
	if($result2->occupation==$job)
	{
		$occupation_id=$result2->id;
	}
}
//echo $occupation_id;

$location=$_POST['location'];			
$sq3 = "INSERT INTO `huangsh1128_cs`.`location` (id, location) VALUES (?,?)";
$ins3 = $db->prepare($sq3);
$ins3->execute(array(NULL,$location));
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
//echo $location_id;

$time=$_POST['time'];
$edu=$_POST['edu'];
$experience=$_POST['experience'];
$salary=$_POST['salary'];
$id=$_SESSION['id'];

$sle4 = "SELECT * FROM `employer`";
$sth4 = $db->prepare($sle4);
$sth4->execute();
$theid3 = $_POST['theid2'];

        //更新資料庫資料語法
		
        $sql = "UPDATE `recruit` SET `employer_id`=?,`occupation_id`=?,`location_id`=?,`working_time`=?,`education`=?,`experience`=?,`salary`=? WHERE `recruit`.`id` =?";
        if($edit_2 = $db->prepare($sql))
        {
				$edit_2->execute(array($id,$occupation_id,$location_id,$time,$edu,$experience,$salary,$theid3));
                ?><script>alert ("edit successful!")</script> <?php
                echo '<meta http-equiv=REFRESH CONTENT=2;url=manage.php>';
        }
        else
        {
                ?><script>alert ("edit failed!")</script> <?php
                echo '<meta http-equiv=REFRESH CONTENT=2;url=manage.php>';
        }

?>