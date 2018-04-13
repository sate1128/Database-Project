<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$id = $_POST['id'];
$password = $_POST['pw'];
//連接帳號資料表，檢查帳密是否正確
$db_server = "dbhome.cs.nctu.edu.tw"; //資料庫主機位置
$db_user = "huangsh1128_cs"; //資料庫的使用帳號
$db_password = "steven449"; //資料庫的使用密碼
$db_name = "huangsh1128_cs"; //資料庫名稱
 
//PDO的連接語法
$dsn = "mysql:host=$db_server;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
//設定為utf8編碼，必要設定
$db->query('SET NAMES "utf8"');  
//echo $_POST['id'];
if( !isset($_POST['id']) || !isset($_POST['pw']) || $_POST['id']=="" || $_POST['pw']=="" ){
//若沒有從Login submit或帳密為空白，就導回Login.php  
echo '<meta http-equiv=REFRESH CONTENT=1;url=login2.php>';
}
else {
// 建立SQL字串，並執行SQL指令，先在SQL指令中要用?留下未來要Binding的資料，在excute中用array來Bind Data，這樣可避免SQL Injection的駭客攻擊
$sql = "SELECT * FROM `huangsh1128_cs`.`employer`";
 
//執行SQL指令，並取得資料結果集合
$sth = $db->prepare($sql);
$sth->execute(array($id, $password));

 $hashpw=sha1($password);

while($result = $sth->fetchObject())
{
if( $result->account==$id&&$result->password==$hashpw ) {  //若有資料，表示帳號密碼正確，設定Session，並導向 Manage.php
$_SESSION['id'] = $result->id;
echo '<meta http-equiv=REFRESH CONTENT=1;url=manage.php>'; 
$tmp=1;
}
}
if($tmp!=1)
{
?>
<h1 ><font color="red" face="Arial">Wrong Account or Password! Please log in again.</font></h1>
<a href='login2.php'>Return to the login page...</a>
<?php
}
}
$pdo = NULL;

 
?>