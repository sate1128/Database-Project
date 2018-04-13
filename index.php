<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_server = "dbhome.cs.nctu.edu.tw";
$db_user = "huangsh1128_cs"; 
$db_password = "steven449"; 
$db_name = "huangsh1128_cs"; 
$dsn = "mysql:host=$db_server;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
$db->query('SET NAMES "utf8"');
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
<a href="logouttt.html"><input type="button"  value="Log out"></a> <br>
<table>
<tr>
<td>
</td>
</tr>
</table>
<h2 align=center ><font face="Arial" color="4FDB42">Job Vacancy</font></h2>


<table id="t01">
  <tr>
    <form name="form" method="post" action="manage.php">
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
   </form>
<?php 
		$sql = "SELECT * FROM `recruit` ORDER BY `id` ASC";
		$sth1 = $db->prepare($sql);
		$sth1->execute();
		
        while($result1=$sth1->fetchObject())
		{
			$nowid =$result1->id;
			$id=$_SESSION['id'];
			
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
					<font face="Arial"><?php echo $result1->id;?></font>
				</td>
			
			<?php
			while($result4=$sth4->fetchObject())
			{
				if($result4->id==$result1->employer_id)
				{?>
				
					<td>
						<font face="Arial"><?php echo $result4->account;?></font>
					</td>
				
				<?php
				$eid=$result1->employer_id;
				}
			}
			while($result2=$sth2->fetchObject())
			{
				if($result2->id==$result1->occupation_id)
				{?>
					<td>
						<font face="Arial"><?php echo $result2->occupation;?></font>
					</td>
				<?php	
				}
			}
			while($result3=$sth3->fetchObject())
			{
				if($result3->id==$result1->location_id)
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
						<font face="Arial"><?php echo $result1->working_time;?></font>
					</td>
					<td>
						<font face="Arial"><?php echo $result1->education;?></font>
					<td>
						<font face="Arial"><?php echo $result1->experience;?></font>
					</td>
					<td>
						<font face="Arial"><?php echo $result1->salary;?></font>
					</td>
					<td></td>
</tr>
	<?php
	}
	?>
</table>     
</body>
<br><br>
