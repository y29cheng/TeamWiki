<?php
require('../db_info.php');
function generate_password() {
	$length = 10;
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$string = '';
	for ($i = 0; $i < $length; $i++) {
		$string .= $characters[mt_rand(0, strlen($characters) - 1)];
	}
	return $string;
}
function update_password($old, $new) {
	global $host, $user, $pass, $db;
	$connect = mysql_connect($host, $user, $pass);
	if (!$connect) return false;
	mysql_select_db($db, $connect);
	$query = "update users set password='$new' where email='$old'";
	return mysql_query($query);
}
function update_profile($old, $new) {
	global $host, $user, $pass, $db;
	$connect = mysql_connect($host, $user, $pass);
	if (!$connect) return false;
	mysql_select_db($db, $connect);
	$first = $new['first_name'];
	$last = $new['last_name'];
	$username = $new['username'];
	$password = $new['password'];
	$email = $new['email'];
	if ($password) {
		$query = "update users set first_name='$first', last_name='$last', username='$username', password='$password', email='$email' where username='$old'";
	} else {
		$query = "update users set first_name='$first', last_name='$last', username='$username', email='$email' where username='$old'";
	}
	return mysql_query($query);
}
?>
