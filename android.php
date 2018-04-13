<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);


$sqlll= "SELECT `id`,`employer_id`,`occupation_id`,`location_id`,`working_time`,`education`,`experience`,`salary` FROM `recruit`";
	$search = $db->prepare($sqlll);
	$search->execute();
	$recruits = $search->fetchALL();
	echo "["; 
	foreach($recruits as $re)
		{
			echo "{";
			echo "\"id\" : \"".$re['id']."\",";
			$sq222 = "SELECT * FROM `occupation`";
			$sth222 = $db->prepare($sq222);
			$sth222->execute();
			
			$sq333 = "SELECT * FROM `location`";
			$sth333 = $db->prepare($sq333);
			$sth333->execute();
			
			$sq444 = "SELECT * FROM `employer`";
			$sth444 = $db->prepare($sq444);
			$sth444->execute();
			
			while($result444=$sth444->fetchObject())
			{
				if($result444->id==$re['employer_id'])
				{
					$employer=$result444->account;
				}
			}
			echo "\"employer\" : \"".$employer."\",";
			while($result222=$sth222->fetchObject())
			{
				if($result222->id==$re['occupation_id'])
				{
					$occupation=$result222->occupation;
				}
			}
			echo "\"occupation\" : \"".$occupation."\",";
			while($result333=$sth333->fetchObject())
			{
				if($result333->id==$re['location_id'])
				{
					$location=$result333->location;
				}
			}
			echo "\"location\" : \"".$location."\",";
			echo "\"working_time\" : \"".$re['working_time']."\",";
			echo "\"education\" : \"".$re['education']."\",";
			echo "\"experience\" : \"".$re['experience']."\",";
			echo "\"salary\" : \"".$re['salary']."\"";
			echo "},";
		}
	echo "]"; 
?>