<?php
require('db_info.php');
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to".$host);
$username = mysql_real_escape_string($_POST['username'], $connect);
$email = mysql_real_escape_string($_POST['email'], $connect);
$password = $_POST['password'];
$encrypt = md5($password);
mysql_select_db($db, $connect);
$query = "select * from users where username='$username'";
$result = mysql_query($query);
if (!mysql_num_rows($result)) {
	$query = "insert into users(username, password, email) values('$username', '$encrypt', '$email')";
	$result = mysql_query($query);
	if (!$result) echo 2;
	else echo 0;
} else {
        echo 1;
}
?>
