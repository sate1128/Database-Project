<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$theid = $_POST['nowid'];

$db_server = "dbhome.cs.nctu.edu.tw"; 
$db_user = "huangsh1128_cs"; 
$db_password = "steven449";
$db_name = "huangsh1128_cs"; 
$dsn = "mysql:host=$db_server;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
$db->query('SET NAMES "utf8"'); 

$sql = "SELECT * FROM `recruit`";
$sth = $db->prepare($sql);
$sth->execute();
while($r=$sth->fetchObject())
{
	if($r->id==$theid)
	{
		$sql1 = "SELECT * FROM `occupation`";
		$sth1 = $db->prepare($sql1);
		$sth1->execute();
		while($r1=$sth1->fetchObject())
		{
			if($r1->id==$r->occupation_id)
			{
				$occupation=$r1->occupation;
			}
		}
		$sql2 = "SELECT * FROM `location`";
		$sth2 = $db->prepare($sql2);
		$sth2->execute();
		while($r2=$sth2->fetchObject())
		{
			if($r2->id==$r->location_id)
			{
				$location=$r2->location;
			}
		}
		$experience=$r->experience;
		$salary=$r->salary;
	}
}
?>
<a href="manage.php"><input type="button"  value="back"></a> <br>
<h1 ><font face="Arial" color="4FDB42">Edit the new job<br></font></h1><br>

<table>
<form name="form" method="post" action="edit_finish.php">
<tr>
	<th><font face="Arial" color="1F6819">Occupation</font></th>
	<th><font face="Arial" color="1F6819">Location</font></th>
	<th><font face="Arial" color="1F6819">Work Time</font></th>
</tr>
<tr>
	<th><font face="Arial"><input type="text" name="job" placeholder="<?php echo $occupation;?>"/> </font></th>
	<th><font face="Arial"><input type="text" name="location" placeholder="<?php echo $location;?>"/> </font></th>
	<th><font face="Arial"><select name="time">
											<option value="Morning">Morning</option>
											<option value="Afternoon">Afternoon</option>
											<option value="Evening">Evening</option>
											<option value="Night">Night</option></font></th>
</tr>
<tr>
	<th><br><font face="Arial" color="1F6819">Education Required</font></th>
	<th><br><font face="Arial" color="1F6819">Minimum of Working Experience</font></th>
	<th><br><font face="Arial" color="1F6819">Salary Per Month</font></th>
</tr>
<tr>
	<th><font face="Arial"><select name="edu">
											<option value="Graduate School">Graduate School</option>
											<option value="Undergraduate School">Undergraduate School</option>
											<option value="Senior High School">Senior High School</option>
											<option value="Junior High School">Junior High School</option>
											<option value="Elementary School">Elementary School</option></font></th>
	<th><font face="Arial"><input type="number" min="0" max="100" value="<?php echo $experience;?>" name="experience"/></font></th>
	<th><font face="Arial"><input type="number" min="0" max="1000000" step="1000" value="<?php echo $salary;?>" name="salary"/></font></th>
</tr>
<tr>
<th><br><br><button type="submit" value="<?php echo $theid ?>" name="theid2">Submit</button></th>
</tr>
</form>
</table>
