<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$id = $_POST['id'];
$password = $_POST['pw'];
//�s���b����ƪ�A�ˬd�b�K�O�_���T
$db_server = "dbhome.cs.nctu.edu.tw"; //��Ʈw�D����m
$db_user = "huangsh1128_cs"; //��Ʈw���ϥαb��
$db_password = "steven449"; //��Ʈw���ϥαK�X
$db_name = "huangsh1128_cs"; //��Ʈw�W��
 
//PDO���s���y�k
$dsn = "mysql:host=$db_server;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
//�]�w��utf8�s�X�A���n�]�w
$db->query('SET NAMES "utf8"');  
//echo $_POST['id'];
if( !isset($_POST['id']) || !isset($_POST['pw']) || $_POST['id']=="" || $_POST['pw']=="" ){
//�Y�S���qLogin submit�αb�K���ťաA�N�ɦ^Login.php  
echo '<meta http-equiv=REFRESH CONTENT=1;url=login2.php>';
}
else {
// �إ�SQL�r��A�ð���SQL���O�A���bSQL���O���n��?�d�U���ӭnBinding����ơA�bexcute����array��Bind Data�A�o�˥i�קKSQL Injection���b�ȧ���
$sql = "SELECT * FROM `huangsh1128_cs`.`employer`";
 
//����SQL���O�A�è��o��Ƶ��G���X
$sth = $db->prepare($sql);
$sth->execute(array($id, $password));

 $hashpw=sha1($password);

while($result = $sth->fetchObject())
{
if( $result->account==$id&&$result->password==$hashpw ) {  //�Y����ơA��ܱb���K�X���T�A�]�wSession�A�þɦV Manage.php
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