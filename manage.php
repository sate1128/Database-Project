<?php session_start(); ?>
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

<?php
	$em = "SELECT * FROM `employer`";
	$eeem = $db->prepare($em);
	$eeem->execute();
	while($r=$eeem->fetchObject())
	{
		if($_SESSION['id']==$r->id)
		{
			?>
			<h1 align=left><font face="Arial" color="4FDB42">Hello <?php echo $r->account;?></font></h2><br>
			<?php
		}
	}
?>
<a href="logout2.php"><input type="button"  value="Log out"></a> <br>
<table>
<tr>
<td>
<form name="form" method="post" action="manage.php">
<input type="text" name="employer" placeholder="Employer"/>
<input type="text" name="occupation" placeholder="Occupation"/>
<input type="text" name="location" placeholder="Location"/>
<input type="text" name="worktime" placeholder="Work time"/>
<input type="text" name="education" placeholder="Education"/>
<input type="text" name="experience" placeholder="Experience(or down)"/>
<input type="text" name="salary" placeholder="Salary(or up)"/>
<input type="submit" name="button" value="Search"  />&nbsp;&nbsp;
</form>
</td>
</tr>
</table>
<?php
if(@$_POST['employer']!=NULL||@$_POST['occupation']!=NULL||@$_POST['location']!=NULL||@$_POST['worktime']!=NULL||@$_POST['education']!=NULL||@$_POST['experience']!=NULL||@$_POST['salary']!=NULL)
{
	$employer=$_POST['employer'];
	$occupation=$_POST['occupation'];
	$location=$_POST['location'];
	$worktime=$_POST['worktime'];
	$education=$_POST['education'];
	$experience=$_POST['experience'];
	$salary=$_POST['salary'];
	$sqlll= "SELECT `id`,`employer_id`,`occupation_id`,`location_id`,`working_time`,`education`,`experience`,`salary` FROM `recruit`";
	$search = $db->prepare($sqlll);
	$search->execute();
	$re = $search->fetchALL();
		?>
		<h1 align=center ><font face="Arial" color="4FDB42">Search Result</font></h1>
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
				if($result444->account==$employer)
				{
					$employer_id=$result444->id;
				}
			}
			//echo $employer_id." ";
			//echo $rrre['employer_id']." ";
			while($result222=$sth222->fetchObject())
			{
				if($result222->occupation==$occupation)
				{
					$occupation_id=$result222->id;
				}
			}
			//echo $occupation_id." ";
			//echo $rrre['occupation_id']." ";
			while($result333=$sth333->fetchObject())
			{
				if($result333->location==$location)
				{
					$location_id=$result333->id;
				}
			}
			//echo $location_id." ";
			//echo $rrre['location_id']." ";
						if($rrre['education']=="Graduate School")
			{
				$edu=5;
			}
			else if($rrre['education']=="Undergraduate School")
			{
				$edu=4;
			}
			else if($rrre['education']=="Senior High School")
			{
				$edu=3;
			}
			else if($rrre['education']=="Junior High School")
			{
				$edu=2;
			}
			else if($rrre['education']=="Elementary School")
			{
				$edu2=1;
			}
			if($education=="Graduate School")
			{
				$edu2=5;
			}
			else if($education=="Undergraduate School")
			{
				$edu2=4;
			}
			else if($education=="Senior High School")
			{
				$edu2=3;
			}
			else if($education=="Junior High School")
			{
				$edu2=2;
			}
			else if($education=="Elementary School")
			{
				$edu2=1;
			}
	if(($employer==NULL||$rrre['employer_id']==$employer_id)&&($occupation==NULL||$rrre['occupation_id']==$occupation_id)&&($location==NULL||$rrre['location_id']==$location_id)&&($worktime==NULL||$worktime==$rrre['working_time'])&&($education==NULL||$edu==$edu2)&&($experience==NULL||$experience>=$rrre['experience'])&&($salary==NULL||$salary<=$rrre['salary']))
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
</table>
<?php
}
?>
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
	<th><font face="Arial" color="FFFFFF">Salary Per Month<button type="submit" name="increase" value="1">/\</button><button type="submit" name="decrease" value="1">\/</button></font></th>
	<th><font face="Arial" color="FFFFFF">Operation</font></th>
	<th></th>
  </tr> 
   </form>
<?php
if($_SESSION['id'] != null)
{ 
	if(@$_POST['increase']==1)
	{
		$sql = "SELECT * FROM `recruit` ORDER BY `salary` ASC";
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
			<?php
			if($id==$eid)
			{
				?>
					<td><form action="edit.php" method="POST">
					<button type="submit" value="<?php echo $nowid ?>" name="nowid">edit</button>
					</form></td>
					<td><form action="delete.php" method="POST">
					<button type="submit" value="<?php echo $nowid ?>" name="nowid">delete</button>
					</form>
					</td>
				
				<?php
			}
			else
			{
				?>
				<td>
				</td>
				<td>
				</td>
				<?php
			}
		}
		?></tr>
</table>
<?php
	}
	else if(@$_POST['decrease']==1)
	{
		$sql = "SELECT * FROM `recruit` ORDER BY `salary` DESC";
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
			<?php
			if($id==$eid)
			{
				?>
				<td><form action="edit.php" method="POST">
					<button type="submit" value="<?php echo $nowid ?>" name="nowid">edit</button>
					</form></td>
					<td><form action="delete.php" method="POST">
					<button type="submit" value="<?php echo $nowid ?>" name="nowid">delete</button>
					</form>
					</td>
				
				<?php
			}
			else
			{
				?>
				<td>
				</td>
				<td>
				</td>
				<?php
			}
		}
		?></tr>
</table>
<?php
	}
	else
	{
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
			<?php
			if($id==$eid)
			{
				?>
				<td><form action="edit.php" method="POST">
					<button type="submit" value="<?php echo $nowid ?>" name="nowid">edit</button>
					</form></td>
					<td><form action="delete.php" method="POST">
					<button type="submit" value="<?php echo $nowid ?>" name="nowid">delete</button>
					</form>
					</td>
				
				<?php
			}
			else
			{
				?>
				<td>
				</td>
				<td>
				</td>
				<?php
			}
		}
		?></tr>
</table>
	<?php
	}
	?>
       
</body>
<br><br>
		<a href="add.php"><input type="button" value="add"></a>
		<a href="list.php"><input type="button" value="JobSeeker List"></a>
		<a href="apply.php"><input type="button" value="Application List"></a>
<?php	
}
else
{
    ?>	<script>alert ("You are not permitted to view this page!")</script> <?php
     echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
}
?>