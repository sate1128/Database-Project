<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

/*$sqll = "SELECT * FROM `recruit`";
$sth11 = $db->prepare($sqll);
$sth11->execute();
$result11=$sth11->fetchAll();*/
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
table#t01 tr:nth-child() {
   background-color:#DCDCDC;
}
table#t01 th	{
    background-color: #C0F9BB;
    color: black;
}
</style>
</head>
<body>
<h1 align=center ><font face="Arial" color="4FDB42">Application List</font></h1>
<a href="manage.php"><input type="button"  value="Back"></a> <br>
<table id="t01">
<?php
  /*
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
  </tr>*/
/*$sql= "SELECT * FROM `favorite`";
$login = $db->prepare($sql);
$login->execute();
$users = $login->fetchAll();

foreach($users as $user)
{	
	if($user['employer_id']==$_SESSION['id'])
	{	*/
		$sql = "SELECT * FROM `recruit`";
		$sth1 = $db->prepare($sql);
		$sth1->execute(array($id, $password));
		$result1=$sth1->fetchAll();
		foreach($result1 as $result111)
		{
			if($_SESSION['id']==$result111['employer_id'])
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
					<th><font face="Arial"><?php echo $result111['id'];?></font></th>
					<?php
				while($result4=$sth4->fetchObject())
				{
					if($result4->id==$result111['employer_id'])
					{
						?>
							<th><font face="Arial"><?php echo $result4->account;?></font></th>
						<?php
					}
				}
				while($result2=$sth2->fetchObject())
				{
					if($result2->id==$result111['occupation_id'])
					{
						?>
							<th><font face="Arial"><?php echo $result2->occupation;?></font></th>
						<?php	
					}
				}
				while($result3=$sth3->fetchObject())
				{
					if($result3->id==$result111['location_id'])
					{
						?>
							<th><font face="Arial"><?php echo $result3->location;?></font></th>
						<?php
					}
				}
				?>
					<th><font face="Arial"><?php echo $result111['working_time'];?></font></th>
					<th><font face="Arial"><?php echo $result111['education'];?></font></th>
					<th><font face="Arial"><?php echo $result111['experience'];?></font></th>
					<th><font face="Arial"><?php echo $result111['salary'];?></font></th>
					<th></th>
					</tr>
				<?php
				$sql= "SELECT * FROM `application`";
				$app = $db->prepare($sql);
				$app->execute();
				$users = $app->fetchAll();
				foreach($users as $user)
				{
					if($result111['id']==$user['recruit_id'])
					{	
						$sqlu= "SELECT * FROM `user`";
						$uu = $db->prepare($sqlu);
						$uu->execute();
						while($uuuuu = $uu->fetchObject())
						{
							if($uuuuu->id==$user['user_id'])
							{
								?>
								<tr>
								<td><font face="Arial"><?php echo$uuuuu->account  ?></font></td>
								<td><font face="Arial"><?php echo$uuuuu->education  ?></font></td>
								<td><font face="Arial"><?php echo$uuuuu->expected_salary  ?></font></td>
								<td><font face="Arial"><?php echo$uuuuu->phone  ?></font></td>
								<td><font face="Arial"><?php echo$uuuuu->gender  ?></font></td>
								<td><font face="Arial"><?php echo$uuuuu->age ?></font></td>
								<td><font face="Arial"><?php echo$uuuuu->email  ?></font></td>
								<td>
								<?php
									$sql2= "SELECT * FROM `user_specialty`";
									$result=$db->prepare($sql2);
									$result->execute();
									$sql3= "SELECT * FROM `specialty`";
									$result3=$db->prepare($sql3);
									$result3->execute();
									$r3=$result3->fetchALL();
									?>
									<select name="s">
									<?php
									while($r=$result->fetchObject())
									{
										if($r->user_id==$uuuuu->id)
										{
											foreach($r3 as $sss)
											{
												if($sss['id']==$r->specialty_id)
												{
													?>
													<option value="s"><?php echo $sss['specialty'] ?></option>
													<?php
												}
											}
										}
									}
									?>
									</select>
									<?php
								?>
								</td>
								<td><form action="deletea.php" method="POST">
									<button type="submit" value="<?php echo $nowid ?>" name="nowid">hire</button>
									</form>
								</td>
								<td></td>
								</tr>
								<?php
								}
							}
						}
					}
				}
			?>
			<?php
		}
	//}
//}
//}
//}	
	?>
</table>
