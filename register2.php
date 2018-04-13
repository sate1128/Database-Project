<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h1 ><font face="Arial" color="4FDB42">Fill in your resume</font></h1><br>

<table>
<form name="form" method="post" action="register2_finish.php">
<tr>
	<th><font face="Arial" color="1F6819">Account</font></th>
	<th><font face="Arial" color="1F6819">Password</font></th>
	<th><font face="Arial" color="1F6819">Password again</font></th>
	<th><font face="Arial" color="1F6819">Major Education</font></th>
	<th><font face="Arial" color="1F6819">Expected Salary</font></th>
</tr>
<tr>
	<th><font face="Arial" color="1F6819"><input type="text" name="id" /></font></th>
	<th><font face="Arial" color="1F6819"><input type="password" name="pw" /></font></th>
	<th><font face="Arial" color="1F6819"><input type="password" name="pw2" /></font></th>
	<th><font face="Arial" color="1F6819"><select name="edu">
											<option value="Graduate School">Graduate School</option>
											<option value="Undergraduate School">Undergraduate School</option>
											<option value="Senior High School">Senior High School</option>
											<option value="Junior High School">Junior High School</option>
											<option value="Elementary School">Elementary School</option></font></th>
	<th><font face="Arial" color="1F6819"><input type="number" min="0" max="1000000" step="1000" value="22000" name="salary"/></font></th>
</tr>
<tr>
	<th><font face="Arial" color="1F6819">Phone number</font></th>
	<th><font face="Arial" color="1F6819">Gender</font></th>
	<th><font face="Arial" color="1F6819">Age</font></th>
	<th><font face="Arial" color="1F6819">Email</font></th>

</tr>

<tr>
	<th><font face="Arial" color="1F6819"><input type="text" name="phone" /></font></th>
	<th><font face="Arial" color="1F6819"><select name="gender">
											<option value="M">Male</option>
											<option value="F">Female</option></font></th>
	<th><font face="Arial" color="1F6819"><input type="number" min="0" max="100" value="20" name="age"/></font></th>
	<th><font face="Arial" color="1F6819"><input type="text" name="mail" /></font></th>
	
	
</tr>
<tr>
<th><font face="Arial" color="1F6819">Specialty</font></th>
</tr>
<?php
		$db_host = "dbhome.cs.nctu.edu.tw";
		$db_name = "huangsh1128_cs";
		$db_user = "huangsh1128_cs";
		$db_password = "steven449";
		$dsn = "mysql:host=$db_host;dbname=$db_name";
		$db = new PDO($dsn, $db_user, $db_password);

		$sle2 = "SELECT * FROM `specialty`";
		$sth2 = $db->prepare($sle2);
		$sth2->execute();
		while($result2=$sth2->fetchObject())
		{
		?>
			<th><input type="checkbox" name="s[]" value="<?php echo  $result2->id ?>"><?php echo  $result2->specialty ?></th>
		<?php
		}
	?>
<tr>
	<th><br><br><button type="submit">submit</button></th>
</tr>

</form>
</table>