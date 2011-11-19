<?php
require('db_info.php');
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
$owner = mysql_real_escape_string($_POST['owner'], $connect);
$title = mysql_real_escape_string($_POST['title'], $connect);
$choice1 = mysql_real_escape_string($_POST['choice1'], $connect);
$choice2 = mysql_real_escape_string($_POST['choice2'], $connect);
$choice3 = mysql_real_escape_string($_POST['choice3'], $connect);
$choice4 = mysql_real_escape_string($_POST['choice4'], $connect);
$modified = date("Y-m-d", time());
mysql_select_db($db, $connect);
$query = "update votes set title='$title', choice1='$choice1', choice2='$choice2', choice3='$choice3', choice4='$choice4', modified='$modified' where owner='$owner'";
$result = mysql_query($query);
if ($result) {
	echo 1;
} else {
	echo 0;
}
?>
