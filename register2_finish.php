<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$edu = $_POST['edu'];
$exp = $_POST['salary'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
$s=$_POST['s'];

$sql3= "SELECT * FROM `huangsh1128_cs`.`user`";
$result3=$db->prepare($sql3);
$result3->execute();
$r=$result3->fetchALL();
$exist=false;

foreach($r as $account_name)
{	
	if($id == $account_name['account'])
	{
		$exist=true;
		?><script>alert ("Your account has existed! Please use another one!")</script> <?php
		echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
		break;	
	}
}
if($exist==false)
{
	if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
	{

		
			//新增資料進資料庫語法
			$sql = "INSERT INTO `huangsh1128_cs`.`user` (id, account, password, education, expected_salary, phone, gender, age, email)"."VALUES (?,?,?,?,?,?,?,?,?)";
			
			if($inserert_2 = $db->prepare($sql))
			{
					$hashpw=sha1($pw);
					$inserert_2->execute(array(NULL, $id, $hashpw,$edu,$exp,$phone,$gender,$age,$mail));
					?><script>alert ("Add successful!")</script> <?php
					echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
			}
			else
			{
					?><script>alert ("Add failed!")</script> <?php
					echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
			}
			
			$sql= "SELECT id FROM `huangsh1128_cs`.`user`". " WHERE `account` = ? AND `password` = ?";
			$sth= $db->prepare($sql);
			$sth->execute(array($id, $hashpw));
			while($result= $sth->fetchObject()) {
				$u_id=$result->id;
			}
			
			
			$sql2 = "INSERT INTO `huangsh1128_cs`.`user_specialty` (id,user_id,specialty_id) VALUES (?,?,?)";
			$ins =$db->prepare($sql2);
			$ins->execute(array(NULL,$u_id,$s[0]));
			
			$sql2 = "INSERT INTO `huangsh1128_cs`.`user_specialty` (id,user_id,specialty_id) VALUES (?,?,?)";
			$ins =$db->prepare($sql2);
			$ins->execute(array(NULL,$u_id,$s[1]));
			
			$sql2 = "INSERT INTO `huangsh1128_cs`.`user_specialty` (id,user_id,specialty_id) VALUES (?,?,?)";
			$ins =$db->prepare($sql2);
			$ins->execute(array(NULL,$u_id,$s[2]));
			
			$sql2 = "INSERT INTO `huangsh1128_cs`.`user_specialty` (id,user_id,specialty_id) VALUES (?,?,?)";
			$ins =$db->prepare($sql2);
			$ins->execute(array(NULL,$u_id,$s[3]));
			
			$sql2 = "INSERT INTO `huangsh1128_cs`.`user_specialty` (id,user_id,specialty_id) VALUES (?,?,?)";
			$ins =$db->prepare($sql2);
			$ins->execute(array(NULL,$u_id,$s[4]));	

	}
	else
	{
			?><script>alert ("You are not permitted to view this page!")</script> <?php
			echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
	}
}

?>