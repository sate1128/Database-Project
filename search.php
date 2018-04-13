<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

$employer=$_POST['employer'];
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$worktime=$_POST['worktime'];
$education=$_POST['education'];
$experience=$_POST['experience'];
$salary=$_POST['salary'];

/*echo $employer;
echo $occupation;
echo $location;
echo $worktime;
echo $education;
echo $experience;
echo $salary;*/
?>
<head>
<style>
table {
    width:100%;
}
table, th, td {
    border: 0px solid green;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #EEEEEE;
}
table#t01 tr:nth-child(odd) {
   background-color:#FFFFFF;
}
table#t01 th	{
    background-color: #C0F9BB;
    color: black;
}
</style>
</head>

<body>
<?php
$sql= "SELECT `id`,`employer_id`,`occupation_id`,`location_id`,`working_time`,`education`,`experience`,`salary` FROM `recruit`";
$search = $db->prepare($sql);
$search->execute();
$re = $search->fetchALL();
		?>
		<h1 align=center ><font face="Arial" color="4FDB42">Search Result</font></h1>
		<a href="manage2.php"><input type="button"  value="Back"></a> <br>
		<table id="t01">
		  <tr>
			<th><font face="Arial" color="FFFFFF">ID</font></th>
			<th><font face="Arial" color="FFFFFF">Employer</font></th>
			<th><font face="Arial" color="FFFFFF">Occupation</font></th>		
			<th><font face="Arial" color="FFFFFF">Location</font></th>
			<th><font face="Arial" color="FFFFFF">Work Time</font></th>
			<th><font face="Arial" color="FFFFFF">Education Require</font></th>
			<th><font face="Arial" color="FFFFFF">Minimum of Working Experience</font></th>
			<th><font face="Arial" color="FFFFFF">Salary Per Month</font></th>
			<th></th>
		  </tr> 
		<?php
		foreach($re as $rrre)
		{
			$sq2 = "SELECT * FROM `occupation`";
			$sth2 = $db->prepare($sq2);
			$sth2->execute();
			
			$sq3 = "SELECT * FROM `location`";
			$sth3 = $db->prepare($sq3);
			$sth3->execute();
			
			$sq4 = "SELECT * FROM `employer`";
			$sth4 = $db->prepare($sq4);
			$sth4->execute();
			
			while($result4=$sth4->fetchObject())
			{
				if($result4->account==$employer)
				{
					$employer_id=$result4->id;
				}
			}
			//echo $employer_id." ";
			//echo $rrre['employer_id']." ";
			while($result2=$sth2->fetchObject())
			{
				if($result2->occupation==$occupation)
				{
					$occupation_id=$result2->id;
				}
			}
			//echo $occupation_id." ";
			//echo $rrre['occupation_id']." ";
			while($result3=$sth3->fetchObject())
			{
				if($result3->location==$location)
				{
					$location_id=$result3->id;
				}
			}
			//echo $location_id." ";
			//echo $rrre['location_id']." ";
	if(($employer==NULL||$rrre['employer_id']==$employer_id)&&($occupation==NULL||$rrre['occupation_id']==$occupation_id)&&($location==NULL||$rrre['location_id']==$location_id)&&($worktime==NULL||$worktime==$rrre['working_time'])&&($education==NULL||$education==$rrre['education'])&&($experience==NULL||$experience==$rrre['experience'])&&($salary==NULL||$salary==$rrre['salary']))
	{
			$sq2 = "SELECT * FROM `occupation`";
			$sth2 = $db->prepare($sq2);
			$sth2->execute();
			
			$sq3 = "SELECT * FROM `location`";
			$sth3 = $db->prepare($sq3);
			$sth3->execute();
			
			$sq4 = "SELECT * FROM `employer`";
			$sth4 = $db->prepare($sq4);
			$sth4->execute();
			?>
			<tr>
				<td>
					<font face="Arial"><?php echo $rrre['id'];?></font>
				</td>
			<?php
			while($result4=$sth4->fetchObject())
			{
				if($result4->id==$rrre['employer_id'])
				{
					?>
					<td>
						<font face="Arial"><?php echo $result4->account;?></font>
					</td>
					<?php
				}
			}
			while($result2=$sth2->fetchObject())
			{
				if($result2->id==$rrre['occupation_id'])
				{
					?>
					<td>
						<font face="Arial"><?php echo $result2->occupation;?></font>
					</td>
					<?php	
				}
			}
			while($result3=$sth3->fetchObject())
			{
				if($result3->id==$rrre['location_id'])
				{
					?>
					<td>
						<font face="Arial"><?php echo $result3->location;?></font>
					</td>
					<?php
				}
			}
			?>
					<td>
						<font face="Arial"><?php echo $rrre['working_time'];?></font>
					</td>
					<td>
						<font face="Arial"><?php echo $rrre['education'];?></font>
					<td>
						<font face="Arial"><?php echo $rrre['experience'];?></font>
					</td>
					<td>
						<font face="Arial"><?php echo $rrre['salary'];?></font>
					</td>
					<td>
					<?php
	}
}

?>
</body>