<?php
require('db_info.php');
require('../vendors/iredis.php');
$owner = $_POST['owner'];
$title = $_POST['title'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];
$choice3 = $_POST['choice3'];
$choice4 = $_POST['choice4'];
$created = date("Y-m-d", time());
$modified = $created;
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
mysql_select_db($db, $connect);
$query = "insert into votes \(title, owner, choice1, choice2, choice3, choice4, created, modified\) values \('$title', '$owner', '$choice1', '$choice2', '$choice3', '$choice4', '$created', '$modified'\)";
$result = mysql_query($query);
if ($result) {
        echo 1;
} else {
        echo 0;
	return;
}
$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
$redis->incr('id');
$tmp = $redis->get('id');
$redis->hset('vote'.$tmp, 'a1', 0);
$redis->hset('vote'.$tmp, 'a2', 0);
$redis->hset('vote'.$tmp, 'a3', 0);
$redis->hset('vote'.$tmp, 'a4', 0);
?>
