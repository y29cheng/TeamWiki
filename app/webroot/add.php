<?php
require('db_info.php');
require('../vendors/iredis.php');
$owner = $_POST['owner'];
$title = $_POST['title'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$choice4 = $_POST['choice4'];
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
mysql_select_db($db, $connect);
$query = "insert into votes (title, owner, choice1, choice2, choice3, choice4) values ('$title', '$owner', '$choice1', '$choice2', '$choice3', '$choice4')";
$result = mysql_query($query);
if ($result) {
	echo 1;
} else {
	echo 0;
}
?>
