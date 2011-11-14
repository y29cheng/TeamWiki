<?php
require('db_info.php');
$username = $_POST['username'];
$password = $_POST['password'];
$encrypt = md5($password);
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to".$host);
mysql_select_db($db, $connect);
$query = "select * from users where username='$username' and password='$encrypt'";
$result = mysql_query($query);
if (!mysql_num_rows($result)) {
        echo 0;
} else {
        echo 1;
}
?>
