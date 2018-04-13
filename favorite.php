<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
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
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th	{
    background-color: #C0F9BB;
    color: black;
}
</style>
</head>
<body>
<h1 align=center ><font face="Arial" color="4FDB42">Favorite List</font></h1>
<a href="manage2.php"><input type="button"  value="Back"></a> <br>
<table id="t01">
  <tr>
    <th><font face="Arial" color="FFFFFF">ID</font></th>
	<th><font face="Arial" color="FFFFFF">Employer</font></th>
    <th><font face="Arial" color="FFFFFF">Occupation</font></th>		
    <th><font face="Arial" color="FFFFFF">Location</font></th>
	<th><font face="Arial" color="FFFFFF">Working_time</font></th>
	<th><font face="Arial" color="FFFFFF">Education</font></th>
	<th><font face="Arial" color="FFFFFF">Experience</font></th>
	<th><font face="Arial" color="FFFFFF">Salary</font></th>
	<th><font face="Arial" color="FFFFFF">Operation</font></th>
	<th></th>
  </tr>
<?php
  
$sql= "SELECT * FROM `favorite`";
$login = $db->prepare($sql);
$login->execute();
$users = $login->fetchAll();

foreach($users as $user)
{	
	if($user['user_id']==$_SESSION['id'])
	{	
		$sql = "SELECT * FROM `recruit`";
		$sth1 = $db->prepare($sql);
		$sth1->execute(array($id, $password));
		$result1=$sth1->fetchAll();
		foreach($result1 as $result111)
		{
			if($user['recruit_id']==$result111['id'])
			{		
			$nowid = $result111['id'];
					
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
				<font face="Arial"><?php echo $result111['id'];?></font>
				</td>
				<?php
			while($result4=$sth4->fetchObject())
			{
				if($result4->id==$result111['employer_id'])
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
				if($result2->id==$result111['occupation_id'])
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
				if($result3->id==$result111['location_id'])
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
				<font face="Arial"><?php echo $result111['working_time'];?></font>
			</td>
			<td>
				<font face="Arial"><?php echo $result111['education'];?></font>
			<td>
				<font face="Arial"><?php echo $result111['experience'];?></font>
			</td>
			<td>
				<font face="Arial"><?php echo $result111['salary'];?></font>
			</td>
			<td><form action="deletef.php" method="POST">
				<button type="submit" value="<?php echo $nowid ?>" name="nowid">delete</button>
				</form>
			</td>
			<?php
		}
		?>	
		</tr>
			<?php
		}
	}
}	
	?>
</table>