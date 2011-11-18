<?php
require('db_info.php');
require('../vendors/iredis.php');
$id = $_POST['id'];
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
mysql_select_db($db, $connect);
$query = "delete from votes where id='$id'";
$result = mysql_query($query);
if ($result) {
	echo 1;
} else {
	echo 0;
}
?>
