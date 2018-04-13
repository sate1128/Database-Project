<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "huangsh1128_cs";
$db_user = "huangsh1128_cs";
$db_password = "steven449";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
//$sql = "SELECT * FROM employer";
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
$sql2= "SELECT * FROM `huangsh1128_cs`.`employer`";
$result=$db->prepare($sql2);
$result->execute();
$r=$result->fetchALL();
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
	if( $id != null && $pw != null && $pw2 != null && $pw == $pw2)
		{
		//新增資料進資料庫語法
			$sql = "INSERT INTO `huangsh1128_cs`.`employer` (id,account, password, phone,mail) VALUES (?,?,?,?,?)";
						
			if($inserert_2 = $db->prepare($sql))
			{
				$hashpw=sha1($pw);
				$inserert_2->execute(array(NULL,$id,$hashpw,$phone,$mail));
				?><script>alert ("Add successful!")</script> <?php
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
			}
			else
			{
				?><script>alert ("Add failed!")</script> <?php
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
			}
		}
		else
		{
			?><script>alert ("You may forget to input the password or input the different password!")</script> <?php
			echo '<meta http-equiv=REFRESH CONTENT=2;url=login2.php>';
		}	
}
	


?>