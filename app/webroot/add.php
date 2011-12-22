<?php
require('../db_info.php');
$counter = intval($_POST['counter']);
$obj = array();
$obj['owner'] = $_POST['owner'];
$obj['voters'] = array();
for ($i = 0; $i < $counter; $i++) {
	if ($i == 0) {
		$obj['title'] = $_POST['title'];
	} else {
		$obj['choice'.$i] = $_POST['choice'.$i];
	}
}
$obj['created'] = date("Y-m-d", time());
$obj['modified'] = $obj['created'];
$obj['choices'] = $counter - 1;
$m = new Mongo("mongodb://".$mongo_user.":".$mongo_pass."@dbh54.mongolab.com:27547/teamwiki");
$db = $m->teamwiki;
$votes = $db->votes;
try {
	$votes->insert($obj, array('safe' => true));
	echo "success";
} catch (MongoCursorException $e) {
	echo "failure";
}
// require('../vendors/iredis.php');
// $connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
// $owner = mysql_real_escape_string($_POST['owner'], $connect);
// $title = mysql_real_escape_string($_POST['title'], $connect);
// $choice1 = mysql_real_escape_string($_POST['choice1'], $connect);
// $choice2 = mysql_real_escape_string($_POST['choice2'], $connect);
// $choice3 = mysql_real_escape_string($_POST['choice3'], $connect);
// $choice4 = mysql_real_escape_string($_POST['choice4'], $connect);
// $created = date("Y-m-d", time());
// $modified = $created;
// mysql_select_db($db, $connect);
// $query = "insert into votes (title, owner, choice1, choice2, choice3, choice4, created, modified) values ('$title', '$owner', '$choice1', '$choice2', '$choice3', '$choice4', '$created', '$modified')";
// $result = mysql_query($query);
// if ($result) {
//         echo 1;
// } else {
//         echo mysql_error();
// 	return;
// }
// $redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
// $redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
// $redis->incr('id');
// $tmp = $redis->get('id');
// $redis->hset('vote'.$tmp, 'a1', 0);
// $redis->hset('vote'.$tmp, 'a2', 0);
// $redis->hset('vote'.$tmp, 'a3', 0);
// $redis->hset('vote'.$tmp, 'a4', 0);
?>
