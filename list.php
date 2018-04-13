<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);


$sql= "SELECT `id`,`account`,`education`,`expected_salary`,`phone`,`gender`,`age`,`email` FROM `user`";
$login = $db->prepare($sql);
$login->execute();
$users = $login->fetchAll();

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
<h1 align=center ><font face="Arial" color="4FDB42">JobSeeker List</font></h1>
<a href="manage.php"><input type="button"  value="Back"></a> <br>

<table id="t01">
  <tr>
    <th><font face="Arial" color="FFFFFF">ID</font></th>
	<th><font face="Arial" color="FFFFFF">Account</font></th>
    <th><font face="Arial" color="FFFFFF">Education</font></th>		
    <th><font face="Arial" color="FFFFFF">Expect_Salary</font></th>
	<th><font face="Arial" color="FFFFFF">Phone</font></th>
	<th><font face="Arial" color="FFFFFF">Gender</font></th>
	<th><font face="Arial" color="FFFFFF">Age</font></th>
	<th><font face="Arial" color="FFFFFF">E-mail</font></th>
	<th><font face="Arial" color="FFFFFF">Specialty</font></th>
  </tr>
  <?php
		foreach($users as $user){	
	
		
		
	?>
	
	</tr>
	<td><font face="Arial"><?php echo$user['id']  ?></font></td>
	<td><font face="Arial"><?php echo$user['account']  ?></font></td>
	<td><font face="Arial"><?php echo$user['education']  ?></font></td>
	<td><font face="Arial"><?php echo$user['expected_salary']  ?></font></td>
	<td><font face="Arial"><?php echo$user['phone']  ?></font></td>
	<td><font face="Arial"><?php echo$user['gender']  ?></font></td>
	<td><font face="Arial"><?php echo$user['age']  ?></font></td>
	<td><font face="Arial"><?php echo$user['email']  ?></font></td>
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
			if($r->user_id==$user['id'])
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
	<br>
	</tr>
	<?php
	}
	?>
	</table>
	