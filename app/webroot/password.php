<?php
require('db_info.php');
$h = $host;
$u = $user;
$p = $pass;
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
	global $h, $u, $p;
	$connect = mysql_connect($h, $u, $p);
	if (!$connect) return false;
	mysql_select_db($db, $connect);
	$query = "update users set password='$new' where password='$old'";
	return mysql_query($query);
}
?>
