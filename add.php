<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="manage.php"><input type="button"  value="back"></a> <br>
<h1 ><font face="Arial" color="4FDB42">Add a new job<br></font></h1><br>
<table>
<form name="form" method="post" action="add_finish.php">

<tr>
	<th><font face="Arial" color="1F6819">Occupation</font></th>
	<th><font face="Arial" color="1F6819">Location</font></th>
	<th><font face="Arial" color="1F6819">Work Time</font></th>
</tr>
<?php 	

$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

$sql= "SELECT * FROM `huangsh1128_cs`.`occupation`";
$result=$db->prepare($sql);
$result->execute();

?>
<tr>
	<th><font face="Arial"><select name="job" >
											<?php while($j=$result->fetchObject())
											{
												?><option value="<?php echo $j->occupation?>"><?php echo $j->occupation?></option><?php
											}
											?></font></th>
<?php	

$sq2= "SELECT * FROM `huangsh1128_cs`.`location`";
$result2=$db->prepare($sq2);
$result2->execute();

?>
	<th><font face="Arial"><select name="location" >
											<?php while($l=$result2->fetchObject())
											{
												?><option value="<?php echo $l->location?>"><?php echo $l->location?></option><?php
											}
											?></font></th>
											
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
	<th><font face="Arial"><input type="number" min="0" max="100"  value="0" name="experience"/></font></th>
	<th><font face="Arial"><input type="number" min="0" max="1000000" step="1000" value="22000" name="salary"/></font></th>
</tr>
<tr>
<th><br><br><button type="submit">Submit</button></th>
</tr>
</form>
</table>
